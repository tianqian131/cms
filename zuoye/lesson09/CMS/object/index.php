<?php include("./admin/public/connectDb.php") ?>
<!DOCTYPE HTML>
<html lang="zh-CN">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="/object/Css/global.css" />
        <link rel="stylesheet" href="/object/Css/blog.css" />
        <script src="/Scripts/debug.js"></script>
    </head>
<body data-mod="blog" class="blog-index ">
    <div class="global-nav sf-header">
        <nav class="container nav">
            <div class="row hidden-xs">
                <div class="col-sm-10 col-md-8 col-lg-7">
                    <div class="sf-header__logo">
                        <h1><a href="/">SegmentFault</a></h1></div>
                </div>
                <div class="col-sm-2 col-md-4 col-lg-5 text-right">
                    <form action="" class="header-search  hidden-sm hidden-xs mr20" method="post">
                        <input type="submit" class="btn btn-link" value="搜索">
                        <input id="searchBox" name="q" type="text" placeholder="输入关键字搜索" class="form-control" value="<?php echo $_POST['q'] ? $_POST['q']:"" ?>" />
                    </form>
                    <ul class="opts list-inline hidden-xs">
                        <li class="opts__item"><a href="/user/login" class="SFLogin em ml10" onClick="_gaq.push(['_trackEvent', 'Button', 'Click', 'Login']);">注册 &middot;登录</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="global-navTags">
        <div class="container">
            <nav class=" nav">
                <ul class="nav__list">
                    <li class="nav__item"><a href="/object/index.php"><i class="fa fa-home"></i>主页
                            </a></li>
                    <li class="nav__item nav__item--split"><a><span class="split"></span></a></li>
                    <?php
                        $sql = "SELECT classname from classify";
                        $res = mysql_query($sql);
                        while(list($class) = mysql_fetch_row($res)){
                    ?>
                    <li class="nav__item tag-nav__item"><a href="?class=<?php echo $class ?>"><?php echo $class ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="wrap">
        <div class="container article__container">
            <div class="row">
                <div class="col-xs-12 col-md-9 main">
                    <div class="main__board">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-zen mb10">
                            <li><a href="">全部的</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="stream-list blog-stream">
                        <?php
                            if($_GET){
                                if($_POST){
                                    $sql = "SELECT articlename,author,content,createdTime FROM article WHERE class='{$_GET['class']}' && articlename LIKE '%{$_POST['q']}%' ";
                                }else{
                                    $sql = "SELECT articlename,author,content,createdTime FROM article WHERE class='{$_GET['class']}'";
                                }
                            }else{
                                if($_POST){
                                    $sql = "SELECT articlename,author,content,createdTime FROM article WHERE articlename LIKE '%{$_POST['q']}%' ";
                                }else{
                                    $sql = "SELECT articlename,author,content,createdTime FROM article";
                                }
                            }
                            $res = mysql_query($sql);
                            while(list($articlename,$author,$content,$createdTime) = mysql_fetch_row($res)){
                        ?>
                            <section class="stream-list__item">
                                <div class="summary">
                                    <h2 class="title"><a href="/a/1190000007601338"><?php echo $articlename ?></a></h2>
                                    <p class="excerpt wordbreak hidden-xs"><?php echo $content ?></p>
                                    <ul class="author list-inline">
                                        <li>
                                            <a href="/u/silentred">
                                                <img class="avatar-20 mr10 hidden-xs" src="/Picture/1f339d36b993412b87b369e57181af7a.gif" alt="一堆好人卡"><?php echo $author ?>
                                            </a>
                                            <span class="split"></span><?php echo date("Y-m-d H:i" , $createdTime) ?>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        <?php } ?>
                        </div>
                    </div>
                    <!-- /.main__board -->
                </div>
                <!-- /.layout-sidebar -->
            </div>
        </div>
    </div>
    <footer id="footer">
        <div class="container">
            <div class="row hidden-xs">
                <dl class="col-sm-2 site-link">
                    <dt>友情链接</dt>
                    <?php
                        $sql = "SELECT linkname,adress FROM friendlink";
                        $res = mysql_query($sql);
                        while(list($linkName,$adress) = mysql_fetch_row($res)){
                    ?>
                    <dd><a href="<?php echo $adress ?>" target="_blank"><?php echo $linkName ?></a></dd>
                    <?php } ?>
                </dl>
            </div>
        </div>
    </footer>
    <script id="loginModal" type="text/template">
        <div class="row bg-white login-modal">
            <div class="col-md-4 col-sm-12 col-md-push-7 login-wrap">
                <h1 class="h4 text-muted login-title">用户登录</h1>
                <form action="/api/user/login" method="POST" role="form" class="mt30">
                    <div class="form-group">
                        <label for="username" class="control-label">手机号 或 Email</label>
                        <input type="text" class="form-control" name="username" required placeholder="11 位手机号 或 Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="control-label">密码</label><span class="pull-right"><a
                                href="/user/forgot">忘记密码</a></span>
                        <input type="password" class="form-control" name="password" required placeholder="密码">
                    </div>
                    <div class="form-group clearfix">
                        <div class="checkbox pull-left">
                            <label>
                                <input name="remember" type="checkbox" value="1" checked> 记住登录状态</label>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right pl20 pr20" onclick='ga("send", "event", "email login button", "clicked", "login modal");'>登录
                        </button>
                    </div>
                </form>
                <p class="h4 text-muted visible-xs-block h4">快速登录</p>
                <div class="widget-login mt30">
                    <p class="text-muted mt5 mr10 pull-left hidden-xs">快速登录</p>
                    <a href="/user/oauth/google" class="" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "google"});'><span
                            class="icon-sn-google"></span> <strong class="visible-xs-inline">Google 账号</strong></a>
                    <a href="/user/oauth/github" class="" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "github"});");'><span
                            class="icon-sn-github"></span> <strong class="visible-xs-inline">Github 账号</strong></a>
                    <a href="/user/oauth/weibo" class="" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "weibo"});'><span
                            class="icon-sn-weibo"></span> <strong class="visible-xs-inline">新浪微博账号</strong></a>
                    <a href="/user/oauth/qq" class="" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "qq"});'><span
                            class="icon-sn-qq"></span> <strong class="visible-xs-inline">QQ 账号</strong></a>
                    <a href="/user/oauth/weixin" class="" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "qq"});'><span
                            class="icon-sn-weixin"></span> <strong class="visible-xs-inline">微信账号</strong></a>
                    <a href="/user/oauth/linkedin" class="" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "linkedin"});'><span
                            class="icon-sn-linkedin"></span> <strong class="visible-xs-inline">LinkedIn 账号</strong></a>
                    <span id="loginShowMore" style="cursor: pointer" class="mb5"><span class="icon-sn-dotted"></span><strong class="visible-xs-inline">•••</strong></span>
                    <a href="/user/oauth/twitter" class=" hidden" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "twitter"});'><span
                            class="icon-sn-twitter"></span> <strong class="visible-xs-inline">Twitter 账号</strong></a>
                    <a href="/user/oauth/facebook" class=" hidden" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "facebook"});'><span
                            class="icon-sn-facebook"></span> <strong class="visible-xs-inline">Facebook 账号</strong></a>
                    <a href="/user/oauth/douban" class=" hidden" onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "douban"});'><span
                            class="icon-sn-douban"></span> <strong class="visible-xs-inline">豆瓣账号</strong></a>
                </div>
            </div>
            <div class="login-vline hidden-xs hidden-sm"></div>
            <div class="col-md-4 col-md-pull-3 col-sm-12 login-wrap">
                <h1 class="h4 text-muted login-title">注册新账号</h1>
                <form action="/api/user/phone/register" method="POST" role="form" class="mt30">
                    <div class="form-group">
                        <label for="name" class="control-label">名字</label>
                        <input type="text" class="form-control" name="name" required placeholder="真实姓名或常用昵称">
                    </div>
                    <div class="form-group js-register-switch-box">
                        <div class="mb10">
                            <label class="radio-inline">
                                <input type="radio" name="register_type" value="phone" checked> 用手机号注册
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="register_type" value="mail"> 用 Email 注册
                            </label>
                        </div>
                        <div class="js-register-switch-content">
                            <input type="phone" class="form-control mb15" name="phone" required placeholder="仅支持大陆手机号" autocomplete="off">
                            <div class="input-group">
                                <input name="code" type="text" class="form-control js-user-login__phone-code-value" placeholder="短信验证码">
                                <span class="input-group-btn"><button class="btn btn-default js-user-login__phone-vaild-btn"
                                                                  style="width:96px;" type="button">获取验证码</button></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">密码</label>
                        <input type="password" class="form-control" name="password" required placeholder="不少于 6 位">
                    </div>
                    <div class="form-group" style="display:none;">
                        <label class="required control-label">验证码</label>
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="请输入下方的验证码">
                        <div class="mt10">
                            <a id="loginReloadCaptcha" href="javascript:void(0)"><img data-src="/Picture/2af330c4c83344c2942c72f54982025c.gif" class="captcha" width="240" height="50" /></a>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="checkbox pull-left">
                            同意并接受<a href="/tos" target="_blank">《服务条款》</a>
                        </div>
                        <button type="submit" class="btn btn-primary pl20 pr20 pull-right" onclick='ga("send", "event", "email register button", "clicked", "login modal");'>注册
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-muted mt30">
        </div>
    </script>
    <script>
    (function(w) {
        w.SF = {
            staticUrl: "https://sf-static.b0.upaiyun.com/v-5837a251"
        };
        w.SF.token = (function() {
            var _uMx = '5d0' //'gz'
                + //'sy'
                '41b' + 'b81' //'eE'
                + 'b36' //'P'
                + 'bab' //'Akt'
                + 'db' //'OVT'
                + '9f' //'ia'
                + //'PA'
                'PA' + '812' //'dj'
                + '9' //'5jR'
                + 'e' //'D'
                + //'Y'
                '379' + '6s' //'6s'
                + //'9'
                'b' + //'N4'
                'd' + 'e1d' //'3M'
                ,
                _fAln = [
                    [19, 21],
                    [27, 29]
                ];

            for (var i = 0; i < _fAln.length; i++) {
                _uMx = _uMx.substring(0, _fAln[i][0]) + _uMx.substring(_fAln[i][1]);
            }

            return _uMx;
        })();;
    })(window);

    var lock = {
        type: "",
        text: '',
        table: {
            "ban_post": [1, "\u4f60\u5df2\u7ecf\u88ab\u7981\u8a00, \u65e0\u6cd5\u8fdb\u884c\u6b64\u64cd\u4f5c, \u5982\u6709\u7591\u4e49\u8bf7\u63d0\u4ea4\u7533\u8bc9, \u6216\u8005\u53d1\u90ae\u4ef6\u5230pr@segmentfault.com"]
        }
    };
    </script>
    <script crossorigin src="/Scripts/assets.js"></script>
    <script crossorigin src="/Scripts/index.min.js"></script>
    <script async src="/Scripts/asyncjs.js"></script>
    <script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-918487-8']);
    _gaq.push(['_trackPageview']);
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');






    ga('create', 'UA-918487-8', 'auto', {
        'userID': 0,
        'createdTime': 0,
        'now': 1480067949
    });
    ga('set', 'dimension1', 'guest');
    ga('send', 'pageview');
    </script>
    <script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?e23800c454aa573c0ccb16b52665ac26";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>

</html>