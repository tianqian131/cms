<?php
//定义打印函数
function p($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

//定义上传函数
function upload($file,$path=null,$type=array('image/png','image/jpg','image/jpeg','image/gif')){
    //判断是否是上传文件
    if(!is_uploaded_file($file['tmp_name'])){
        return false;
    }
    //判断上传文件类型
    if(!in_array($file['type'], $type)){
        return false;
    }
    //判断上传文件大小
    if($file['size'] > 1024*1024*4){
        return false;
    }
    //重定义文件名
    $filename = date("YmdHi").mt_rand(100,999);
    //判断用户是否自己添加路径
    if(is_null($path)){
        @$ext = array_pop(explode(".", $file['name']));
        $filename = date("YmdHi").mt_rand(100,999).'.'.$ext;
        $path = $_SERVER['DOCUMENT_ROOT'].'/object/uploads/';

    }else{
        $path = rtrim($path,'/').'/';
        $filename = $path.$filename;
    }

    //上传文件路径
    $filePath = $path.$filename;
    //将上传文件移动到指定位置
    if(move_uploaded_file($file['tmp_name'], $filePath)){
        return $filename;
    }else{
        return false;
    }
}

?>