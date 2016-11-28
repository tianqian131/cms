<?php
include("../public/connectDb.php");
if($_POST){
    $class = $_POST;
    $sql = "UPDATE classify SET classname='{$class['classname']}' WHERE classname = '{$class['oldClassname']}'";
        if(mysql_query($sql)){
        header("location: ./classify.php");
    }else{
        echo "<scirpt>alert('修改失败，请换名重试');window.history.back()</script>";
    }
}

?>