<?php
include("../public/acl.php");
include("../public/connectDb.php");

//获取要修改用户的ID
$uid = $_SESSION['master']['id'];
//从数据库查询出该用户信息
$sql = "SELECT username,email,status,sex,pic,isAdmin FROM user WHERE id = {$uid}";
$res = mysql_query($sql);

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="../css/common.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script type="text/javascript" src="../js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
<?php 
include("../public/topbar.php");
?>
</div>
<div class="container clearfix">
<?php 
include("../public/sidebar.php");
?>   
   <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="./user.php">用户管理</a><span class="crumb-step">&gt;</span><span>修改用户</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="./do_mod_user.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <?php
                                while(list($username,$email,$status,$sex,$pic,$isAdmin) = mysql_fetch_row($res)){
                            ?>
                                <tr>
                                    <th><i class="require-red">*</i>用户名：</th>
                                    <td>
                                        <input class="common-text required" id="username" name="username" value="<?php echo $username ?>" type="text">
                                    </td>
                                </tr>
    							 <tr>
                                    <th><i class="require-red">*</i>密码：</th>
                                    <td>
                                        <input class="common-text required" id="password" name="pwd" value="" type="password">
                                    </td>
                                </tr>
    							 <tr>
                                    <th><i class="require-red">*</i>确认密码：</th>
                                    <td>
                                        <input class="common-text required" id="repwd" name="repwd" value="" type="password">
                                    </td>
                                </tr>
                                <tr>
                                    <th>邮箱：</th>
                                    <td><input class="common-text" name="email" value="<?php echo $email ?>"  type="text"></td>
                                </tr>
                                <tr>
                                    <th>状态:</th>
                                    <td>
                                        <input type="radio" name="status" value="1" <?php echo $status == 1 ? "checked" : "" ?>>正常
                                        <input type="radio" name="status" value="0" <?php echo $status == 2 ? "checked" : "" ?>>锁定
                                    </td>
                                </tr>
                                <tr>
                                    <th>性别:</th>
                                    <td>
                                        <input type="radio" name="sex" value="男" <?php echo $sex == "男" ? "checked" : "" ?>>男
                                        <input type="radio" name="sex" value="女" <?php echo $sex == "女" ? "checked" : "" ?>>女
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="require-red">*</i>头像：</th>
                                    <td><input name="pic" type="file">
                                        <input type="hidden" name="oldPic" value="<?php echo $pic ?>">
                                        <img src="<?php echo "../../uploads/".$pic ?>" width="35px">
                                    </td>
                                </tr>
                                <tr>
                                    <th>是否设置管理员:</th>
                                    <td>
                                        <input type="radio" name="isAdmin" value="1" <?php echo $isAdmin == "1" ? "checked" : "" ?>>是
                                        <input type="radio" name="isAdmin" value="2" <?php echo $isAdmin == "2" ? "checked" : "" ?>>否
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="hidden" name="id" value="<?php echo $uid ?>">
                                        <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                        <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>