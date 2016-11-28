<?php
include("../public/connectDb.php");
if($_POST){
    // 获取更新的文章信息
    $article =array_filter($_POST);
    $oldArticle = $article['oldArticle'];
    unset($article['oldArticle']);
    $article['createdTime'] = time();
    $info = "";
    foreach ($article as $key => $value) {
        $info .= $key."="."'".$value."',";
    }
    $info = rtrim($info,',');
    // 更新数据库文章信息
    $sql = "UPDATE article SET {$info} WHERE id={$oldArticle}";
    if(mysql_query($sql)){
        header("location: ./article.php");
    }else{
        echo "<script>alert('添加失败,请重试');window.history.back()</script>";
    }
}
?>