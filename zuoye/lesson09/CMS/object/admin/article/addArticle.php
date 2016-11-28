<?php
include("../public/acl.php");
include("../public/connectDb.php");
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
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="./article.php">文章管理</a><span class="crumb-step">&gt;</span><span>新增文章</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="./do_addArticle.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>文章名：</th>
                                <td>
                                    <input class="common-text required" id="articlename" name="articlename" size="50" value="" type="text">
                                </td>
                            </tr>
                                <th>作者：</th>
                                <td><input class="common-text" name="author" size="50"  type="text"></td>
                            </tr>
                            <tr>
                                <th>所属类别:</th>
                                <th>
                                    <select style="float: left;margin-left: 10px;width: 100px" name='class' >
                                        <?php
                                            $sql = "SELECT classname FROM classify ORDER BY id ASC";
                                            $classname = mysql_query($sql);
                                                while($res = mysql_fetch_row($classname)){
                                                    foreach ($res as $v) {
                                                    echo "<option value='{$v}'>{$v}</option>";
                                                }
                                            }   
                                        ?>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td><textarea name="content" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"></textarea></td>
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