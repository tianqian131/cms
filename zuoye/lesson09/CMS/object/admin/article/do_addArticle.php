<?php
include("../public/function.php");
include("../public/connectDb.php");
if($_POST){
    // 获取用户输入的文章信息并格式化
    $article =array_filter($_POST);
    $article['createdTime'] = time();
    $key = implode(',', array_keys($article));
    $val = "'".implode("','", array_values($article))."'";
    // 添加到数据库
    $sql = "INSERT INTO article({$key}) VALUE ({$val})";
    if(mysql_query($sql)){
        header("location: ./article.php");
    }else{
        echo "<script>alert('添加失败,请重试');window.history.back()</script>";
    }
}


?>