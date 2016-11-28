<?php
include_once("../public/function.php");
include("../public/connectDb.php");
//获取要删除用户的id
$id = $_GET['id'];

//获取要删除的用户的头像信息
$pic = "SELECT pic FROM user WHERE id = {$id}";
$picRes = mysql_query($pic);
$arr = mysql_fetch_assoc($picRes);

//图像路径
$filename = "../../uploads/".$arr['pic'];

//删除图像
if($picRes){
    unlink($filename);
}

//删除指定用户
$sql = "DELETE FROM user WHERE id = {$id}";
$res = mysql_query($sql);
if($res){
echo "<script>alert('删除成功');window.location.href='user.php';</script>";
}else{

}





?>