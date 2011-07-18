配置在config.php中

默认demo的地址是 http://localhost/weibodemo/

我们自己用的话请使用yiqiplayclient.php中的Yiqiplayclient类

2011.5.15 weibooauth.php 新增了话题和搜索的接口在 WeiboClient 里面
2011.5.31 yiqiplayclient.php 封装了几个主要的接口，还需要把返回值从array改为对应的class

附注：

message:
	snstype : sina wb = 1;
	
user:
	新浪微博 province 和 city 是两个值， 怎么处理　Uhomeid， 目前是 province*1000 + city
	age: 微博user没有age属性

Locid 需要一个search的方法。