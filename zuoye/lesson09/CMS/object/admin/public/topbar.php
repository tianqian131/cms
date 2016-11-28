<div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="../index.php">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="#"><?php echo $_SESSION['master']['username'] ?></a></li>
                <li><a href="/object/admin/user/modifyUser.php">修改密码</a></li>
                <li><a href="/object/admin/loginout.php">退出</a></li>
            </ul>
        </div>
    </div>
