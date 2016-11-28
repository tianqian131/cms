<?php 
include("../public/function.php");
include("../public/connectDb.php");

//获取修改信息
if($_POST){
    $user = array_filter($_POST);
    $tmp = $user['oldPic'];
    unset($user['oldPic']);
}
//获取头像信息
if($_FILES){
    $pic = upload($_FILES['pic']);
    $user['pic'] = $pic;
}else{
    $user['pic'] = $tmp;
}

//密码修改
if(isset($user['pwd']) || isset($user['repwd'])){
    if($user['pwd'] == $user['repwd']){
        $user['pwd'] = md5($user['pwd']);
        unset($user['repwd']);
    }else{
        echo "<script>alert('密码和确认密码不一致,请重新输入');window.history.back();</script>";
        return false;
    }
}

//获取修改用户的id
$id = $user['id'];
unset($user['id']);

//定义数据库语法
$str = "";
foreach ($user as $key => $value) {
    $str .= $key."='".$value."',";    
}
$str = rtrim($str,',');
$sql = "UPDATE user SET {$str} WHERE id = {$id}";

//判断是否修改成功
if(mysql_query($sql)){
    unlink("../../uploads/".$tmp);
    echo "<script>alert('修改成功');window.location.href='user.php'</script>";
}else{
    echo "<script>alert('修改失败');window.history.back();</script>";
}

 ?>