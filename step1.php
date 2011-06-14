<?
session_start();

if(isset($_SESSION['accessKey'])&&isset($_REQUEST['oauth_verifier'])){
	header('Location: index.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>一起玩</title>
<link type="text/css" rel="stylesheet" href="assets/yq.css" />
<script src="assets/jquery.min.js"></script>
</head>
<body>
<p id="follow_us"><a href="">关注@一起play</a></p>
<p id="m_head">一人学跳舞没动力？一人看电影觉得无聊？想找个伴去旅行？一个人去健身难坚持？一起play，给你找玩伴！</p>
<div class="main choose">
<form name="ido" action="step2.php" method="post">
<ol class="step">
	<li class="step_1">
    	<em>第一步，选择一起play的活动类型</em>
        <ul class="dotype">
        	<li><input name="dotype" type="radio" value="我想去" />我想去</li>
        	<li><input name="dotype" type="radio" value="我想学" />我想学</li>
        	<li><input name="dotype" type="radio" value="我想玩" />我想玩</li>
        </ul>
    </li>
	<li class="step_2">
    	<em>第二步，我想去干吗？</em>
        <textarea class="dowhat" name="ido">可以直接输入地点或活动</textarea>
        <button type="submit" class="do" >提交</button>
    </li>
</ol>
</form>
</div>
<p id="foot">copyright by yiqiplay@163.com</p>
</body>
</html>
