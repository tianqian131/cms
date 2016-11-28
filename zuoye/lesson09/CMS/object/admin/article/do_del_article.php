<?php
include("../public/connectDb.php");
// 获取要删除的文章id并删除
$id = $_GET['id'];
$sql = "DELETE FROM article WHERE id = {$id}";
if(mysql_query($sql)){
    header("location: ./article.php");
}
?>