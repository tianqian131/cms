<?php
include_once("../public/function.php");
include("../public/connectDb.php");


//创建用户
if($_POST){
    //是否上传图像
    if($_FILES){
        $pic = upload($_FILES['pic']);
    }

    $user = $_POST;
    //密码是否输入正确
    if($user['pwd'] == $user['repwd']){
        $user['pwd'] = md5($user['pwd']);
        unset($user['repwd']);
    }

    //转换数据格式插入到数据库
    $user['pic'] = $pic;
    $user['createdTime'] = time();
    $user = array_filter($user);
    $key = implode(',', array_keys($user));
    $val = '"'.implode('","',array_values($user)).'"';
    $flied = "INSERT INTO user(".$key.") VALUE (".$val.");";
    if(mysql_query($flied)){
        echo "<script>alert('添加成功');window.location.href='user.php'</script>";
    }else{
        echo "<script>alert('添加失败，用户名重复');window.history.back();</script>";

    }
}




?>