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
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="../index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">用户管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="70">用户名:</th>
                            <td><input class="common-text" placeholder="用户名" name="username" type="text"></td>
                            <td><input class="btn btn-primary btn2" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="./addUser.php"><i class="icon-font"></i>新增用户</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
            
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <!-- <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>                         -->
                            <th>ID</th>
                            <th>用户名</th>
                            <th>状态</th>
                            <th>头像</th>
                            <th>邮箱</th>
                            <th>性别</th>
                            <th>管理员</th>
                            <th>注册时间</th>
                            <th>操作</th>
                        </tr>
                        <?php
                        //按条件查询用户
                        $search = $_POST;
                        @$where = "WHERE username LIKE '%{$search['username']}%'";
                        //查询一共多少条数据
                         $sql = "SELECT count(id) count FROM user {$where}";
                         $res = mysql_query($sql);
                         $res = mysql_fetch_assoc($res);
                         $count = $res['count'];
                         //每页显示的条数
                         $num = 2; 
                         // 总页数
                         $page = ceil($count / $num);
                         //起始点
                         @$spot = $_GET['page'] ? $_GET['page'] : 1 ;
                         $startPage = ($spot - 1)*$num;
                         $limit = 'LIMIT '.$startPage.','.$num;
                        //按条件遍历出用户并显示
                         $sql= "SELECT id,username,status,pic,email,sex,isAdmin,createdTime FROM user {$where} ORDER BY id desc {$limit}";
                         $res = mysql_query($sql); 
                         while(list($id,$username,$status,$pic,$email,$sex,$isAdmin,$createdTime) = mysql_fetch_row($res)){ ?>
                        <tr>
                            <!-- <td class="tc"><input name="id[]" value="59" type="checkbox"></td> -->
                            <td>
                                <?php echo $id ?>
                            </td>
                            <td><?php echo $username ?></td>
                            <td><?php echo $status == 1 ? "正常" : "禁用" ?></td>
                            <td><img src="<?php echo "../../uploads/".$pic ?>" width="40px"></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $sex ?></td>
                            <td><?php echo $isAdmin == 1 ? "是" : "否"?></td>
                            <td><?php echo date("Y-m-d H:i",$createdTime) ?></td>
                            <td>
                                <a class="link-update" href="modifyUser.php?id=<?php echo $id ?>">修改</a>
                                <a class="link-del" href="./delUser.php?id=<?php echo $id ?>">删除</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    <div class="list-page">
                    <?php
                    // 分页
                    if($spot != 1){
                        echo "<a href='?page=1'> 首页 </a>";
                    }
                    // 判断显示页和当前页
                    if($spot >0 && $spot < 4){
                        for ($i=1; $i < $spot; $i++) { 
                            echo "<a href='?page=".$i."'>".$i."</a>";
                        }
                    }else{
                        for ($i=$spot-3; $i < $spot; $i++) { 
                            echo "<a href='?page=".$i."'>".$i."</a>";
                        }
                    }
                    echo "<a href='#' style='color:red'>".$spot."</a>";
                    if($spot < $page - 4){
                        for ($i=$spot+1; $i < $spot+4; $i++) { 
                            echo "<a href='?page=".$i."'>".$i."</a>";
                        }
                    }else{
                        for ($i=$spot+1; $i <= $page; $i++) { 
                            echo "<a href='?page=".$i."'>".$i."</a>";
                        }
                    }
                    if($spot != $page){
                        echo "<a href='?page=".$page."'>尾页</a>";
                    }
                    ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>