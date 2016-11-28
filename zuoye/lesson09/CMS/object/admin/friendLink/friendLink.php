<?php 
include("../public/acl.php");
include("../public/connectDb.php")
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
include("../public/topbar.php")
?>
</div>
<div class="container clearfix">
<?php include("../public/sidebar.php") ?>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">友情链接管理</span></div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="addLink.php"><i class="icon-font"></i>新增友情链接</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>地址</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        
                            <?php
                                $sql = "SELECT * FROM friendlink";
                                $res = mysql_query($sql);
                                while(list($id,$linkname,$adress,$createdTime) = mysql_fetch_row($res)){
                            ?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $linkname ?></td>
                            <td><?php echo $adress ?></td>
                            <td><?php echo date("Y-m-d H:i",$createdTime) ?></td>
                            <td>
                                <a class="link-update" href="mod_addLink.php?id=<?php echo $id ?>">修改</a>
                                <a class="link-del" href="delLink.php?id=<?php echo $id ?>">删除</a>
                            </td>
                        </tr>
                            <?php } ?>
                    </table>
                    <div class="list-page"> 2 条 1/1 页</div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>