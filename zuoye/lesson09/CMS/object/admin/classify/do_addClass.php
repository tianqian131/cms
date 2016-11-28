<?php
include("../public/connectDb.php");
if($_POST){
    $classname = $_POST['classname'];
    $sql = "INSERT INTO classify(classname) value('{$classname}')";
    $res =mysql_query($sql);
    if($res){
        header("location: ./classify.php");
    }
}

?>