<?php
//连接数据库
$link = mysql_connect('localhost','root','root');

//判断数据库是否连接成功
if(mysql_errno()){
    exit('连接失败'.mysql_error());
}

//使用jkxy数据库
$useData = "use jkxy";
mysql_query($useData);

//设置默认语言
mysql_set_charset("utf8");
?>