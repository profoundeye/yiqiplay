<?php
include_once("weiboclient.php");
/***************
   Yiqiplay  微博操作类****************/

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
	 
    function __construct( $akey , $skey , $accecss_token , $accecss_token_secret ) 
    { 
        $this->oauth = new WeiboOAuth( $akey , $skey , $accecss_token , $accecss_token_secret ); 
    } 

	/**
	 * 完成用户token的获取
	 1.new 一个 weibooauth
	 2.生成一个auth url
	 */	 
	/**
	 * 
	 */	 
	/**
	 * 
	 */	 
	
	
	/**
	 * 获取当前授权用户用户身份信息 & 写入注册用户信息库
	 */
	/**
	 * 用户发布求伴微博
	 */
	/**
	 * 一起Play官方微博发布求伴微博
	 */
	/**
	 * 搜索关键词
	 */
	/**
	 * 
	 */	 
	 
	 
	
}


?>