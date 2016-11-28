<?php
include("../public/acl.php");
include_once("../public/function.php");

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
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="./user.php">用户管理</a><span class="crumb-step">&gt;</span><span>新增用户</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="./do_add_user.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        
                            <tr>
                                <th><i class="require-red">*</i>用户名：</th>
                                <td>
                                    <input class="common-text required" id="username" name="username" size="50" value="" type="text">
                                </td>
                            </tr>
							 <tr>
                                <th><i class="require-red">*</i>密码：</th>
                                <td>
                                    <input class="common-text required" id="password" name="pwd" size="50" value="" type="password">
                                </td>
                            </tr>
							 <tr>
                                <th><i class="require-red">*</i>确认密码：</th>
                                <td>
                                    <input class="common-text required" id="repwd" name="repwd" size="50" value="" type="password">
                                </td>
                            </tr>
                            <tr>
                                <th>邮箱：</th>
                                <td><input class="common-text" name="email" size="50"  type="text"></td>
                            </tr>
                            <tr>
                                <th>状态:</th>
                                <td>
                                    <input type="radio" name="status" value="1" checked>正常
                                    <input type="radio" name="status" value="2">锁定
                                </td>
                            </tr>
                            <tr>
                                <th>性别:</th>
                                <td>
                                    <input type="radio" name="sex" value="男" checked>男
                                    <input type="radio" name="sex" value="女">女
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>头像：</th>
                                <td><input name="pic" id="" type="file"><!--<input type="submit" onclick="submitForm('/jscss/admin/design/upload')" value="上传图片"/>--></td>
                            </tr>
                            <tr>
                                <th>是否设置管理员:</th>
                                <td>
                                    <input type="radio" name="isAdmin" value="1" checked>是
                                    <input type="radio" name="isAdmin" value="2">否
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
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