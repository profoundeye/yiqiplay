<?php
include_once( "config.php" );
include_once( SOURCE."/client/weiboclient.php");
include_once( SOURCE."/data/message.php" );
include_once( SOURCE."/data/user.php" );
include_once( SOURCE."/data/location.php" );
include_once( SOURCE."/data/keyword.php" );
include_once( SOURCE."/data/keyindex.php" );
/***************
   Yiqiplay  微博操作类
****************/

class YiqiplayClient
{

    /** 
     * 构造函数 
     *  
     * @access public 
     * @param mixed $akey 微博开放平台应用APP KEY 
     * @param mixed $skey 微博开放平台应用APP SECRET 
     * @param mixed $accecss_token OAuth认证返回的token 
     * @param mixed $accecss_token_secret OAuth认证返回的token secret 
     * @return void 
     */ 
	 
    function __construct( $access_token , $access_token_secret ) 
    { 
		$this->WBclient = new WeiboClient( WB_AKEY , WB_SKEY , $access_token , $access_token_secret ); 
    } 

	/**
	 * 完成用户Oauth URL的获取
	 */
	 public static function getAuthURL($callback_URL)
	 {
		$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );

		$keys = $o->getRequestToken();
		$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback_URL);
		
		$_SESSION['keys'] = $keys; //需要session在页面间传递RequestToken，想了一下，这个不适合在DB里面存储
		
		return $aurl;
	 }

	/**
	 *  获取用户的AcessToken：使用Callback页面获取的token/secret/verifier获取用户的AccessToken
	 */	 
	 public static function getAccessToken($oauth_token, $oauth_token_secret, $oauth_verifier)
	 {
		$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $oauth_token , $oauth_token_secret  );

		$last_key = $o->getAccessToken( $oauth_verifier ) ;

		return $last_key;
	 }	
	 
	/**
	 *  判断用户是否已经微博授权
	 *  return array();
	 *  用户已经授权给Yiqiplay，数据库中有信息则返回已经存储的token和secret
	 *  用户授权给Yiqiplay，正在callback页面，则直接验证，返回token和secret
	 *  用户尚未授权，需要提供AuthURL
	 */	

	 public static function hasWeiboAuth( $callback_URL = MY_CHECKING)
	 {
		$result = array();
		
		
		if(isset($_REQUEST['oauth_verifier']))
		{
			// 用户正在Callback页面
			$result['accessKey'] = self::getAccessToken($_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret'],$_REQUEST['oauth_verifier']);
			$result['value'] = true;
		}elseif ( isset($_SESSION['accessKey']['oauth_token'])){
			// 用户已经授权,session中有accessKey, 验证有效性,返回token/secret

			$tmp_WBclient = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['accessKey']['oauth_token'] , $_SESSION['accessKey']['oauth_token_secret']); 
			$verifyMsg = $tmp_WBclient->verify_credentials();
			if (isset($verifyMsg['name']))
			{
				$result['value'] = true;
				$result['accessKey'] = $_SESSION['accessKey'];
			}
		}else {
			// 该用户session中的accessKey失效 or 没有授权给Yiqiplay 
				$result['value'] = false;
				$result['aurl'] = self::getAuthURL($callback_URL);
		}
		
		return $result;
	 
	 }
	
	/**
	 * 获取当前授权用户用户身份信息 & 写入注册用户信息库
	 */
	 function verify_credentials()
	 {
		$arr_user = $this->WBclient->verify_credentials();
		
	
		return $this->translateUser($arr_user);

	 }

	/**
	 * 查询用户信息
	 */
	 function show_user($uid_or_name)
	 {
		$arr_user = $this->WBclient->show_user($uid_or_name);

		return $this->translateUser($arr_user);
	 }

	/**
	 * 查询指定用户的微博列表
	 */
	 function user_timeline($page = 1 , $count = 20 , $uid_or_name = null)
	 {
	 
		$user_timeline = $this->WBclient->user_timeline( $page = 1 , $count = 20 , $uid_or_name = null );
		
		$arr_message = array();
		
		foreach ( $user_timeline as $key => $arr_wb)
		{
		
			$tmp_wb = new Message();
			$tmp_wb->setMid($arr_wb['mid']);
			$tmp_wb->setSnstype(SNSTYPE_SINA);
			$tmp_wb->setSnsmid($arr_wb['mid']);
			$tmp_wb->setSnsuid($arr_wb['user']['id']);
			$tmp_wb->setContent($arr_wb['text']);
			$tmp_wb->setUhomeid($arr_wb['user']['province']*1000 + $arr_wb['user']['city']); 
			$tmp_wb->setLocid($arr_wb['geo']['coordinates'][0].'|'.$arr_wb['geo']['coordinates'][1]);
			
			$arr_message[$key] = $tmp_wb;
			unset($tmp_wb);
		
		}
		
		
		return $arr_message;

	 }
	 /**
	 * 用户发布微博
	 */
	 
	 function update($content)
	 {
		$arr_wb = $this->WBclient->update($content);
		$wb = new Message();
		$wb->setMid($arr_wb['mid']);
		$wb->setSnstype(SNSTYPE_SINA);
		$wb->setSnsmid($arr_wb['mid']);
		$wb->setSnsuid($arr_wb['user']['id']);
		$wb->setContent($arr_wb['text']);
		$wb->setUhomeid($arr_wb['user']['province']*1000 + $arr_wb['user']['city']); 
		$wb->setLocid($arr_wb['geo']['coordinates'][0].'|'.$arr_wb['geo']['coordinates'][1]);
		
		return $wb;
	 }
	/**
	 * 一起Play官方微博发布求伴微博
	 Todo:
	 */
	/**
	 * 搜索关键词 - 直接调用搜索接口，有权限限制，可能失败
	 */
	 
	 function searchKeyword ( $keyword , $result_num = 30)
	 {
	 
		$search_list = $this->WBclient->search_status($keyword);
		
		$arr_message = array();
		$i = 0;
		foreach ( $search_list as $key => $arr_wb)
		{
			$tmp_wb = $this->translateMessage($arr_wb);
			$arr_message[$key] = $tmp_wb;
			unset($tmp_wb);
			$i++;
			if ($i >= $result_num) {
				break;
			}
		}
		
		
		return $arr_message;
	 
	 }
	/**
	 * 搜索关键词（话题）
	 * 搜索API只针对合作方开放，目前使用话题接口，效果和搜索的结果不同，内容差异比较大，时间上不够新。
	 */	 
	 function searchTrend ( $keyword , $result_num = 30)
	 {
	 
		$trend_list = $this->WBclient->get_trends($keyword);
		
		$arr_message = array();
		
		foreach ( $trend_list as $key => $arr_wb)
		{
		
			$tmp_wb = translateMessage($arr_wb);			
			$arr_message[$key] = $tmp_wb;
			unset($tmp_wb);
		
		}
		
		
		return $arr_message;

	}
	
	private function translateUser($wb_user){
		$user = new User();
		$user->setUid($wb_user['id']);
		$user->setUsername($wb_user['name']);
		$user->setGender($wb_user['gender']);
		$user->setAge(-1); // no age for sina weibo
		$user->setBirthday('');// no birthday for sina weibo
		$user->setHomeid($wb_user['province']*1000+$wb_user['city']);
		$user->setSnstype(SNSTYPE_SINA);
		$user->setSnsuid($wb_user['id']);
		$user->setSnsproimg($wb_user['profile_image_url']);
		$user->setExtend(json_encode($wb_user));
		return $user;
	}
	
	private function translateMessage($wb_msg) {
		$message = new Message();
		$message->setMid($wb_msg['mid']);
		$message->setSnstype(SNSTYPE_SINA);
		$message->setSnsmid($wb_msg['mid']);
		$message->setSnsuid($wb_msg['user']['id']);
		$message->setContent($wb_msg['text']);
		$message->setUhomeid($wb_msg['user']['province']*1000 + $wb_msg['user']['city']); 
		$message->setLocid($wb_msg['geo']['coordinates'][0].'|'.$wb_msg['geo']['coordinates'][1]);
		$message->setUser($this->translateUser($wb_msg['user']));
		return $message;
	}
	/**
	 *  显示对象的状态
	 */

	function toString()
	{
	
		return "access_token: $access_token ; access_token_secret: $access_token_secret \n";
	
	}	 
	 
	
}
?>