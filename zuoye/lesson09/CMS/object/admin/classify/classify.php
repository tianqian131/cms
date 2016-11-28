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
            <div class="crumb-list"><i class="icon-font"></i><a href="./index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">用户管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="/jscss/admin/design/index" method="post">
                    <table class="search-tab">
                        <tr>
                           
                            <th width="70">用户名:</th>
                            <td><input class="common-text" placeholder="用户名" name="keywords" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="addClass.php"><i class="icon-font"></i>新增类别</a>            
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>                       
                            <th>ID</th>
                            <th>类名</th>
                            <th>文章数量</th>
                            <th>操作</th>
                        </tr>
                        <?php
                            // 从数据库查询出分类信息并显示出来
                            $sql = "SELECT * FROM classify ORDER BY id ASC";
                            $res = mysql_query($sql);
                            while($row = mysql_fetch_array($res)) {
                                // 从数据库查询文章数量
                                $selectClass = "SELECT count(id) count FROM article WHERE class='{$row['classname']}'";
                                $classRes = mysql_query($selectClass);
                                $count = mysql_fetch_assoc($classRes);
                                $num = $count['count'];
                                
                        ?>
                        <tr>
                            <td class="tc"><?php echo $row['id'] ?></td>
                            <td><?php echo $row['classname'] ?></td>
                            <td><?php echo $num ?></td>
                            <td>
                                <a class="link-update" href="./mod_class.php?id=<?php echo $row['id'] ?>">修改</a>
                                <a class="link-del" href="./do_delClass.php">删除</a>
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