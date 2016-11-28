<?php

include("./public/connectDb.php");
session_start();

if($_POST){
    $username = htmlspecialchars($_POST['username']);
    $pwd = md5($_POST['pwd']);

    $sql = "SELECT * FROM user WHERE username = '{$username}' AND pwd = '{$pwd}' AND isAdmin = 1 ";
    $res = mysql_query($sql);
    $master = mysql_fetch_assoc($res);

    if($master){
        $_SESSION['master'] = $master;
        $_SESSION['isLogin'] = 1;
        // print_r($_SESSION);die;
        echo "<script>window.location.href='index.php'</script>";
    }else{
        echo "<script>alert('登录失败,账号密码错误');window.history.back()</script>";
    }
}

?>
