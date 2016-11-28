<?php
include("../public/acl.php");
include("../public/connectDb.php");
$id = $_GET['id'];
$sql = "SELECT classname FROM classify WHERE id = {$id}";
$res = mysql_query($sql);
$classname = mysql_fetch_assoc($res);
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
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="./classify.php">分类管理</a><span class="crumb-step">&gt;</span><span>新增用户</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="./do_mod_class.php" method="post" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>                                                   
                            <tr>
                                <th><i class="require-red">*</i>修改类名：</th>
                                <td>
                                    <input class="common-text required" value="<?php echo $classname['classname'] ?>" id="classname" name="classname" size="50" type="text">
                                </td>
                            <tr>
                                <th></th>
                                <td>
                                    <input type="hidden" name="oldClassname" value="<?php echo $classname['classname'] ?>">
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>