<?php
include("../public/connectDb.php");
if($_POST){
	$link = $_POST;
	$oldLink = $link['oldLink'];
	unset($link['oldLink']);
	$str = '';
	foreach ($link as $key => $value) {
		$str .= $key."='".$value."',"; 
	}
	$str = rtrim($str,',');
	$sql = "UPDATE friendlink SET {$str} WHERE linkname='{$oldLink}'";
	if(mysql_query($sql)){
		echo "<script>window.location.href='./friendLink.php'</script>";
	}else{
		echo "<script>alert('修改失败');window.history.back()</script>";
	}
}
?>