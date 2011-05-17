<?php

session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );

//当前用户的WeiboClient
$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );

//一起Play的WeiboClient 。一起play的access token 和secret "e9c332833d5ee7b415065bbc5d6a7d41" "b77c76294836ff1b07fc0e378fdb8fb1"
$yqw_c = new WeiboClient( WB_AKEY , WB_SKEY , "e9c332833d5ee7b415065bbc5d6a7d41" , "b77c76294836ff1b07fc0e378fdb8fb1" );

?>

保持用户的token和secret，在用户解除授权之前，原则上是永远有效的。<br />

<?php 

// Todo 需要保存当前用户和一起Play的access token和secret 到DB
echo CodingUtil::parse_all_htmlentities(print_r($_SESSION['last_key'],TRUE));

?>

获取当前授权用户用户身份信息 & 写入注册用户信息库<br />
<?php

$current_user = $c->verify_credentials(); // 验证当前授权用户是否开通了微博服务，同时取得用户信息

echo CodingUtil::parse_all_htmlentities(print_r($current_user,TRUE));//CodingUtil::parse_all_htmlentities 字符串转为HTML代码，调试用

	//$user_info = $c->show_user($current_user['id']);  //打印指定用户的信息，返回格式同上

?>

用户发布求伴微博 <br />

<?php

$new_wb = "@一起play：我想去吃个冰淇淋，有人愿意同行吗？";

//使用WeiboClient的update方法，直接以当前用户的身份发布，纯文本
//$update_wb = $c->update($new_wb);
//echo CodingUtil::parse_all_htmlentities(print_r($update_wb,TRUE));

?>

一起Play官方微博发布求伴微博 <br />
<?php

//一起play官方微博的发布方式貌似应该是与当前用户是相同的
$new_wb = "来自$current_user[location]的@$current_user[screen_name] 想去火星和奥巴马约会，有人愿意同行吗？"; // 理论上应该从DB获取用户的用户名和所在地，此处用上面获取的数据了
echo $new_wb;
//$update_wb = $yqw_c->update($new_wb);
//echo CodingUtil::parse_all_htmlentities(print_r($update_wb,TRUE));

?>

显示一组用户的信息 <br />

<?php 

//Todo  从DB获取用户信息，直接展示
echo "//从DB获取用户信息，直接展示 <br />";

?>

搜索关键词（话题） <br />

<?php

//搜索API只针对合作方开放，目前使用话题接口，效果和搜索的结果不同，内容差异比较大，时间上不够新。

$trend = "我想要滑雪";
//$trend_list = $c->get_trends($trend);
//echo CodingUtil::parse_all_htmlentities(print_r($trend_list,TRUE));

?>

搜索关键词 <br />

<?php

//搜索API只针对合作方开放，目前使用话题接口，效果和搜索的结果不同，内容差异比较大，时间上不够新。

$keyword = "我想要滑雪";
$search_list = $c->search_status($keyword);
//echo CodingUtil::parse_all_htmlentities(OAuthUtil::urldecode_rfc3986(print_r($search_list,TRUE)));
echo CodingUtil::parse_all_htmlentities(print_r($search_list,TRUE));
?>
