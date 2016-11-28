<?php
include("../public/connectDb.php");
if($_POST){
	$link = $_POST;
	$link['createdTime'] = time();
	$key = implode(',',array_keys($link));
	$value = "'".implode("','", array_values($link))."'";
	$sql = "INSERT INTO friendlink ({$key}) VALUE ({$value})";
	if(mysql_query($sql)){
		echo "<script>window.location.href='./friendLink.php'</script>";
	}else{
		echo "<script>alert('添加失败，名称已存在');window.history.back()</script>";
	}
}
?>