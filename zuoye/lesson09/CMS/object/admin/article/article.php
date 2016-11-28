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
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select style="float: left;margin-left: 10px;width: 130px" name='class' >
                                    <option value='select' >查询当类文章</option>
                                    <?php
                                        $sql = "SELECT classname FROM classify ORDER BY id ASC";
                                        $classname = mysql_query($sql);
                                        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                                            $current_class = $_POST['class'];
                                        }
                                            while($res = mysql_fetch_row($classname)){
                                                foreach ($res as $v) {
                                                if (isset($current_class) && $v == $current_class) {
                                                    echo "<option value='{$v}' selected='selected'>{$v}</option>";
                                                } else {
                                                    echo "<option value='{$v}'>{$v}</option>";
                                                }
                                            }
                                        }   
                                    ?>
                                </select>
                            </td>
                            <td>
                            <input type="hidden" name="selected" value="<?php echo $v ?>">
                            <input class="btn btn-primary btn2" type="submit">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="./addArticle.php"><i class="icon-font"></i>新增作品</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>ID</th>
                            <th>标题</th>
                            <th>作者</th>
                            <th>字数</th>
                            <th>更新时间</th>
                            <th>是否通过</th>
                            <th>所属类别</th>
                            <th>评论数</th>
                            <th>操作</th>
                        </tr>
                        <?php
                            //分页
                            $sqlCount = "select count(id) count from article";
                            $res = mysql_query($sqlCount);
                            $count = mysql_fetch_assoc($res);
                            //查询出所有文章条数
                            $allArticle = $count['count'];
                            //每页显示条数
                            $limit = 2;
                            //总共页数
                            $page = ceil($allArticle / $limit);
                            //当前页
                            @$currentPage = $_GET['page'] ? $_GET['page'] : 1;
                            //数据库查询起点位置
                            $spot = ($currentPage - 1) * $limit;
                            $LIMIT = "LIMIT $spot".","."$limit";
                            // 查询出文章信息并循环输出
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                $class = $_POST;
                                if($class['class'] == 'select' ){
                                    $sql = "SELECT * FROM article ORDER BY createdTime DESC {$LIMIT}";
                                }else{
                                    $sql = "SELECT * FROM article WHERE class='{$class['class']}'  ORDER BY createdTime DESC {$LIMIT}";
                                }
                            } else {
                                $sql = "SELECT * FROM article  ORDER BY createdTime DESC {$LIMIT} ";
                            }

                            
                            $res = mysql_query($sql);
                            $row = mysql_num_rows($res);
                            if($row <= 0){
                                echo "<script>alter('没有此类文章');window.history.back()'</script>";
                            }
                            while($row = mysql_fetch_array($res)){

                        ?>
                        <tr>
                            <td class="tc"><input name="id[]" value="59" type="checkbox"></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['articlename'] ?></td>
                            <td><?php echo $row['author'] ?></td>
                            <td><?php echo mb_strlen($row['content'],'utf-8') ?></td>
                            <td><?php echo date("Y-m-d H:i",$row['createdTime']) ?></td>
                            <td><?php echo $row['status']==1 ? "是":"否" ?></td>
                            <td><?php echo $row['class']?></td>
                            <td></td>
                            <td>
                                <!-- 通过get传递要操作文章的id -->
                                <a class="link-update" href="modArticle.php?id=<?php echo $row['id'] ?>">修改</a>
                                <a class="link-del" href="do_del_article.php?id=<?php echo $row['id'] ?>">删除</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    <div class="list-page">
                        <?php
                            //分页
                            if($currentPage != 1){
                                echo "<a href='?page=1'>首页</a>";
                            }
                            if($currentPage < 4){
                                for ($i=1; $i < $currentPage; $i++) { 
                                    echo "<a href='?page={$i}'>{$i}</a>";
                                }
                            }else{
                                for ($i=$currentPage - 3; $i < $currentPage ; $i++) { 
                                    echo "<a href='?page={$i}'>{$i}</a>";
                                }
                            }
                            echo "<a style='color:red'>{$currentPage}</a>";
                            if($currentPage <= $page - 3){
                                for ($i=$currentPage + 1; $i <= $currentPage +3 ; $i++) { 
                                    echo "<a href='?page={$i}'>{$i}</a>";
                                    }
                                }else{
                                    for ($i= $currentPage + 1; $i <= $page ; $i++) { 
                                        echo "<a href='?page={$i}'>{$i}</a>";
                                    }
                            }
                            if($currentPage != $page){
                                echo "<a href='?page={$page}'>尾页</a>";
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