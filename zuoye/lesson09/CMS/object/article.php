


<!DOCTYPE HTML><html lang="zh-CN"><head><meta charset="UTF-8"/><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/><meta name="renderer" content="webkit"/><meta property="qc:admins" content="15317273575564615446375"/><meta property="og:image" content="https://sf-static.b0.upaiyun.com/v-5837a251/global/img/touch-icon.png"/><meta name="viewport"
              content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/><meta name="alexaVerifyID" content="LkzCRJ7rPEUwt6fVey2vhxiw1vQ"/><meta name="apple-itunes-app" content="app-id=958101793, app-argument="><title>基于容器的后端服务架构 - JasonCodes - SegmentFault</title><meta name="description" content="基于容器的后端服务架构 在探索kubernetes的应用时，调研了几个gateway，发现fabio支持发现服务，自动生成路由，结合consul，registrator, 可以很容易的部署一套服务，比较轻量，很容易玩起来。 结构大致为： Sta..."/><meta name="keywords" content="microservice,docker,backend"/><link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="SegmentFault"/><link rel="shortcut icon" href="https://sf-static.b0.upaiyun.com/v-5837a251/global/img/favicon.ico"/><link rel="apple-touch-icon" href="https://sf-static.b0.upaiyun.com/v-5837a251/global/img/touch-icon.png"><meta name="msapplication-TileColor" content="#009a61"/><meta name="msapplication-square150x150logo" content="https://sf-static.b0.upaiyun.com/v-5837a251/global/img/touch-icon.png"/><meta name="userId" value="1030000007604361" id="SFUserId"/><meta name="userRank" value="0" id="SFUserRank"/><link rel="alternate" type="application/atom+xml" title="SegmentFault 最新问题" href="/feeds/questions"><link rel="alternate" type="application/atom+xml" title="SegmentFault 最新文章" href="/feeds/blogs"><link rel="stylesheet" href="https://sf-static.b0.upaiyun.com/v-5837a251/global/css/global.css"/><link rel="stylesheet" href="https://sf-static.b0.upaiyun.com/v-5837a251/blog/css/blog.css"/><link rel="stylesheet" href="https://sf-static.b0.upaiyun.com/v-5837a251/global/css/responsive.css"/><!--[if lt IE 9]><link rel="stylesheet" href="https://sf-static.b0.upaiyun.com/v-5837a251/global/css/ie.css"/><script src="https://sf-static.b0.upaiyun.com/v-5837a251/global/script/html5shiv.js"></script><script src="https://sf-static.b0.upaiyun.com/v-5837a251/global/script/respond.js"></script><![endif]--><script src="https://sf-static.b0.upaiyun.com/v-5837a251/global/script/debug.js"></script></head><body data-mod="blog"
    class="blog-post "><!--[if lt IE 9]><div class="alert alert-danger topframe" role="alert">你的浏览器实在<strong>太太太太太太旧了</strong>，放学别走，升级完浏览器再说 <a target="_blank" class="alert-link" href="http://browsehappy.com">立即升级</a></div><![endif]--><img id="icon4weChat" style="height: 0;width: 0;" data-src="https://sf-static.b0.upaiyun.com/v-5837a251/global/img/touch-icon-512.png"><img id="icon4weChat" data-src="https://sf-static.b0.upaiyun.com/v-5837a251/global/img/touch-icon-512.png"><div class="global-nav sf-header"><nav class="container nav"><div class="hidden-sm hidden-lg hidden-md"><div class="sf-header__logo sf-header__logo--response"><h1><a></a></h1></div><div class="dropdown m-menu"><a href="javascript:void(0);" id="dLabel" class="visible-xs-block m-toptools"
           data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-align-justify"></span><span class="mobile-menu__unreadpoint"></span></a><ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"><li class="mobile-menu__item"><a href="/news">头条</a></li><li class="mobile-menu__item"><a href="/questions/newest">问答</a></li><li class="mobile-menu__item"><a href="/blogs">文章</a></li><li class="mobile-menu__item"><a href="/user/note">笔记</a></li><li class="mobile-menu__item"><a href="/jobs">职位</a></li><li class="mobile-menu__item"><a href="/events">活动</a></li><li class="mobile-menu__item"><a href="/tags">标签</a></li><li class="mobile-menu__item"><a href="/users">榜单</a></li><li class="mobile-menu__item"><a href="/sites">子站</a></li><li role="presentation" class="divider"></li><li class="mobile-menu__item"><a href="/user/notifications">消息<span
                                class="pull-right badge mt4"
                                id="m-messageCount"></span></a></li><li role="presentation" class="divider"></li><li class="mobile-menu__item"><a href="/api/user/logout?_=d2628895beb2a3f7ca7f6ec8c0c32610">退出</a></li></ul></div><a href="/write" class="visible-xs-block pull-right m-ask m-toptools"><span
                        class="glyphicon glyphicon-pencil"></span></a></div><div class="row hidden-xs"><div class="col-sm-10 col-md-8 col-lg-7"><div class="sf-header__logo"><h1><a href="/">SegmentFault</a></h1></div><ul class="menu list-inline pull-left hidden-xs"><li class="menu__item menu__item--new"><a href="/news">头条</a></li><li class="menu__item"><a href="/questions">问答</a></li><li class="menu__item"><a href="/blogs">专栏</a></li><li class="menu__item"><a href="/jobs">职位</a></li><li class="menu__item"><a href="/events">活动</a></li><li class="menu__item menu__item-sfdc--new"><a href="/sfdc-2016/hz">SFDC</a></li></ul></div><div class="col-sm-2 col-md-4 col-lg-5 text-right"><form action="/search" class="header-search  hidden-sm hidden-xs mr20"><button class="btn btn-link"><span class="sr-only">搜索</span><span class="glyphicon glyphicon-search"></span></button><input id="searchBox" name="q" type="text"  placeholder="输入关键字搜索" class="form-control"
                                   value=""/></form><ul class="opts list-inline hidden-xs"><li class="opts__item dropdown hoverDropdown write-btns"><a class="dropdownBtn" data-toggle="dropdown" href="/ask"><i class="fa fa-plus" aria-hidden="true"></i><span
                                                class="caret"></span></a><ul class="dropdown-menu dropdown-menu-right "><li
                                                                                                ><a href="/submit">发头条</a></li><li
                                                                                                ><a href="/ask">提问题</a></li><li
                                                                                                ><a href="/write">写文章</a></li><li
                                                                                                ><a href="/record">记笔记</a></li><li class="divider"></li><li><a href="/user/draft">草稿箱</a></li></ul></li><li class="opts__item message has-unread hidden-sm"><a id="dLabel" class="dropdown-toggle-message" href="/user/notifications"><span class="sr-only">消息</span><span id="messageCount" class="fa fa-bell-o"></span></a><div class="opts__item--message hide"><div class="panel panel-default"><div class="panel-heading"><ul class="nav nav-tabs nav-tabs-message"><li role="presentation" class="active"><a href="#messageGeneral" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                       aria-expanded="true"><i class="fa fa-bullhorn"></i><span class="notice-dot hide notice-dot-general"></span></a></li><li role="presentation" class=""><a href="#messageRanked" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                       aria-expanded="true"><i class="fa fa-thumbs-o-up"></i><span class="notice-dot hide notice-dot-ranked"></span></a></li><li role="presentation" class=""><a href="#messageFollowed" id="home-tab" role="tab" data-toggle="tab" aria-controls="home"
                       aria-expanded="true"><i class="fa fa-user-plus"></i><span class="notice-dot hide notice-dot-followed"></span></a></li></ul></div><div class="panel-body"><div class="tab-content"><div role="tabpanel" class="tab-pane active" id="messageGeneral"></div><div role="tabpanel" class="tab-pane" id="messageRanked"></div><div role="tabpanel" class="tab-pane" id="messageFollowed"></div><script type="text/template" id="messageGeneralTpl"><ul class="mCustomScrollbar-message" data-proto="general"  data-mcs-theme="minimal-dark"><% _.each(general,function(d){ %><li class="<%= d.viewed>0 ?'':'bg-warning'%>"><%= d.sentence %>&nbsp;<a
                                    href="<%= d.url %>"><%= d.excerpt %></a></li><% }) %></ul></script><script type="text/template" id="item--general"><% _.each(general,function(d){ %><li class="<%= d.viewed>0 ?'':'bg-warning'%>"><%= d.sentence %>&nbsp;<a
                                    href="<%= d.url %>"><%= d.excerpt %></a></li><% }) %></script><script type="text/template" id="messageRankedTpl"><ul class="mCustomScrollbar-message" data-proto="ranked"  data-mcs-theme="minimal-dark"><% _.each(ranked,function(d){ %><li class="<%= d.viewed>0 ?'':'bg-warning'%>"><span class="badge
                                                    <% if(d.voted && d.voted.rank!=0){ %><%= d.voted.rank > 0 ? 'green':'red' %><% } else { %> transparent <% } %>"><% if(d.voted){ %><%= d.voted.rank > 0 ? '+'+d.voted.rank:d.voted.rank %><% } %></span><div class="rank-desc"><%= d.sentence %>&nbsp;<a href="<%= d.url %>"><%=
                                    d.excerpt %></a></div></li><% }) %></ul></script><script type="text/template" id="item--ranked"><% _.each(ranked,function(d){ %><li class="<%= d.viewed>0 ?'':'bg-warning'%>"><span class="badge
                                                    <% if(d.voted && d.voted.rank!=0){ %><%= d.voted.rank > 0 ? 'green':'red' %><% } else { %> transparent <% } %>"><% if(d.voted){ %><%= d.voted.rank > 0 ? '+'+d.voted.rank:d.voted.rank %><% } %></span><div class="rank-desc"><%= d.sentence %>&nbsp;<a href="<%= d.url %>"><%=
                                    d.excerpt %></a></div></li><% }) %></script><script type="text/template" id="messageFollowedTpl"><ul class="mCustomScrollbar-message" data-proto="followed"  data-mcs-theme="minimal-dark"><p class="follow-tips">他们最近关注了你</p><% _.each(followed,function(d){ %><li class="<%= d.viewed>0 ?'':'bg-warning'%>"><img class="follower__img avatar-32"
                                 src="<%= d.triggerUser[0] ? d.triggerUser[0].avatarUrl : '' %>"><div class="follower__info"><% if(d.triggerUser[0] ? d.triggerUser[0].isFollowed : ''){ %><button data-id="<%= d.triggerUser[0] ? d.triggerUser[0].id : '' %>"
                                        class="btn btn-default btn-xs message__btn--unfollow pull-right active">
                                    已关注
                                </button><% }else{ %><button data-id="<%= d.triggerUser[0] ? d.triggerUser[0].id : '' %>"
                                        class="btn btn-default btn-xs message__btn--follow pull-right">
                                    关注
                                </button><% } %><a href="<%= d.triggerUser[0] ? d.triggerUser[0].url : '' %>"><%=d.triggerUser[0] ? d.triggerUser[0].name : ''%></a><br><span><%= d.triggerUser[0] ? d.triggerUser[0].rank : '' %> 声望</span></div></li><% }) %></ul></script><script type="text/template" id="item--followed"><% _.each(followed,function(d){ %><li class="<%= d.viewed>0 ?'':'bg-warning'%>"><img class="follower__img avatar-32"
                                 src="<%= d.triggerUser[0] ? d.triggerUser[0].avatarUrl : '' %>"><div class="follower__info"><% if(d.triggerUser[0] && d.triggerUser[0].isFollowed){ %><button data-id="<%= d.triggerUser[0] ? d.triggerUser[0].id : '' %>"
                                        class="btn btn-default btn-xs message__btn--unfollow pull-right active">
                                    已关注
                                </button><% }else{ %><button data-id="<%= d.triggerUser[0] ? d.triggerUser[0].id : '' %>"
                                        class="btn btn-default btn-xs message__btn--follow pull-right">
                                    关注
                                </button><% } %><a href="<%= d.triggerUser[0] ? d.triggerUser[0].url : '' %>"><%= d.triggerUser[0].name
                                    %></a><br><span><%= d.triggerUser[0].rank %> 声望</span></div></li><% }) %></script></div><p class="opts__item--message-loading follow-tips">loading</p></div><div class="panel-footer"><div class="row"><div class="col-sm-6"><a href="javascript:;" class="message-ingore-all hide"><span
                                class="glyphicon glyphicon-ok-sign"></span>
                        全部标记为已读</a></div><div class="col-sm-6"><a class="opts__item--message-view-all" href="/user/notifications">查看全部
                        &raquo;</a></div></div></div></div></div></li><li class="opts__item letter has-unread hidden-sm"><a id="dLabel" class="dropdown-toggle-letter" href="/user/messages"><span class="sr-only">私信</span><span id="letterCount" class="fa fa-envelope-o"></span></a><div class="opts__item--letter hide"><div class="panel panel-default"><div class="panel-heading"><ul class="nav nav-tabs nav-tabs-letter"><li role="presentation" class="active"><span class="opts__item--letter-heading">最近的私信</span></li></ul></div><div class="panel-body"><div class="tab-content"><div id="messageInbox"></div><script type="text/template" id="messageInboxTpl"><ul class="mCustomScrollbar-message" data-proto="inbox" data-mcs-theme="minimal-dark"><% _.each(inboxes,function(d){ %><li class="<%= d.viewed>0 ?'':'bg-warning'%>" data-click="<%= d.url %>"><img class="follower__img avatar-32"
                                     src="<%= d.targetUser.avatarUrl %>"><div class="follower__info"><a href="<%= d.url %>"><%= d.targetUser.name
                                        %></a><br><% if (d.lastMessage.content){ %><span class="ellipsis inline-block" style="width: 245px;"><%= d.lastMessage.content.content %></span><% } %></div></li><% }) %><% if(inboxes.length ==0){ %><p class="text-center">没有人给你发私信</p><% } %></ul></script><script type="text/template" id="item--inboxes"><% _.each(inboxes,function(d){ %><li class="<%= d.viewed>0 ?'':'bg-warning'%>" data-click="<%= d.url %>"><img class="follower__img avatar-32"
                                     src="<%= d.targetUser.avatarUrl %>"><div class="follower__info"><a href="<%= d.targetUser.url %>"><%= d.targetUser.name
                                        %></a><br><span class="ellipsis inline-block" style="width: 245px;"><%= d.content %></span></div></li><% }) %></script></div><p class="opts__item--letter-loading follow-tips">loading</p></div><div class="panel-footer"><div class="row"><div class="col-sm-6"><a href="javascript:;" class="message-ingore-all hide"><span
                                class="glyphicon glyphicon-ok-sign"></span>
                        全部标记为已读</a></div><div class="col-sm-6"><a class="opts__item--message-view-all" href="/user/messages">查看全部
                        &raquo;</a></div></div></div></div></div></li><li class="opts__item user dropdown hoverDropdown"><a class="dropdownBtn user-avatar" data-toggle="dropdown"
                                       style="background-image: url('https://sf-static.b0.upaiyun.com/v-5837a251/global/img/user-64.png')"
                                       href="/u/xiatian_58382f75a6026"></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="/u/xiatian_58382f75a6026">我的主页</a></li><li><a href="/u/xiatian_58382f75a6026/about">我的档案</a></li><li><a href="/user/assets">我的资产</a></li><li><a href="/user/settings">账号设置</a></li><li><a href="/api/user/logout?_=d2628895beb2a3f7ca7f6ec8c0c32610">退出</a></li><li class="divider"></li><li><a href="https://board.segmentfault.com/">建议反馈</a></li><li><a class="js__action--complain" href="javascript:void(0);">用户申诉</a></li><script type="text/template" id="js__action--complain-tpl"><form class="complain__form" method="post" action="/api/appeals/add"><div class="form-group"><label>理由</label><textarea name="description" class="form-control"
                                                              rows="3"></textarea></div></form></script></ul></li></ul></div></div></nav></div><div class="global-navTags"><div class="container"><nav class=" nav"><ul class="nav__list"><li class="nav__item"><a href="/"><i class="fa fa-home"></i>home
                            </a></li><li class="nav__item"><a href="/timeline"><i class="fa fa-list-alt"></i>feed
                            </a></li><li class="nav__item nav__item--split"><a><span class="split"></span></a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/javascript">javascript</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/php">php</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/python">python</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/java">java</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/mysql">mysql</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/ios">ios</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/android">android</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/node.js">node.js</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/html5">html5</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/linux">linux</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/c%2B%2B">c++</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/css3">css3</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/git">git</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/golang">golang</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/ruby">ruby</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/vim">vim</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/docker">docker</a></li><li class="nav__item tag-nav__item"><a
                                                                                href="/t/mongodb">mongodb</a></li><li class="nav__item nav__item--more" data-open="0"><a class="nav__item--more-link"
                                                                               href="/tags"><div class="tag__more"><i class="tag__more--icon"></i><i class="tag__more--icon"></i><i class="tag__more--icon"></i></div></a></li></ul><div class="tag-mgr__box hide"><input class="tag-mgr__query" type="text" placeholder="搜索关注的标签"
                               data-tags='null'><div class="mCustomScrollbar" data-mcs-theme="minimal-dark"><ul class="tag-mgr__list"></ul></div><a href="/tags" class="btn btn-primary btn-sm tag-mgr__btn">标签管理</a></div></nav></div></div>
    <div class="wrap">
    <div class="post-topheader custom-">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <span class="post-topheader__title--icon-symbol">文</span>

                    <div class="post-topheader__info" data-username="一堆好人卡"
                         data-userslug="silentred"
                         data-useravatar="https://sfault-avatar.b0.upaiyun.com/132/731/1327316133-558556c424cd8_big64">

                        <h1 class="h3 post-topheader__info--title" id="articleTitle" data-id="1190000007601338">

                            <a href="/a/1190000007601338"> 基于容器的后端服务架构</a>
                        </h1>

                        <ul class="taglist--inline inline-block article__title--tag mr10">
                                                            <li class="tagPopup mb5"><a class="tag" href="/t/microservice/blogs" data-toggle="popover"
                                                            data-img="" data-placement="top"
                                                            data-original-title="microservice"
                                                            data-id="1040000002930495">microservice</a></li>
                                                            <li class="tagPopup mb5"><a class="tag" href="/t/docker/blogs" data-toggle="popover"
                                                            data-img="https://sfault-avatar.b0.upaiyun.com/269/397/2693973775-1040000000366352_huge256" data-placement="top"
                                                            data-original-title="docker"
                                                            data-id="1040000000366352">docker</a></li>
                                                            <li class="tagPopup mb5"><a class="tag" href="/t/backend/blogs" data-toggle="popover"
                                                            data-img="" data-placement="top"
                                                            data-original-title="backend"
                                                            data-id="1040000004688712">backend</a></li>
                                                    </ul>

                        <div class="article__author">
                            <a href="/u/silentred" class="mr5 "><strong>一堆好人卡</strong></a>
                            7 小时前发布
                                                                                </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 hidden-xs">
                    <ul class="post-topheader__side list-unstyled">
                        <li>
                                                                                                <button type="button" class="btn btn-success btn-sm" data-id="1190000007601338"
                                            id="sideLike">推荐
                                    </button>
                                                                                        <strong id="sideLiked">0</strong> 推荐
                        </li>
                        <li>
                                                                                                <button type="button" id="sideBookmark" class="btn btn-default btn-sm"
                                            data-id="1190000007601338" data-id="1190000007601338" data-type="article">收藏
                                    </button>
                                                                                        <strong id="sideBookmarked">0</strong> 收藏，<strong
                                    class="no-stress">94</strong> 浏览
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- end .post-topheader -->

    <div class="container mt30">
        <div class="row">
            <div class="col-xs-12 col-md-9 main ">

                
                <div class="article fmt article__content" data-id="1190000007601338" data-license="cc">
                    <html><body>
<h1>基于容器的后端服务架构</h1>
<blockquote><p>在探索kubernetes的应用时，调研了几个gateway，发现fabio支持发现服务，自动生成路由，结合consul，registrator, 可以很容易的部署一套服务，比较轻量，很容易玩起来。</p></blockquote>
<p>结构大致为：<br><img data-src="/img/bVF3BB?w=1206&amp;h=1119"></p>
<h2>Start Consul</h2>
<p>安装 consul, 如果检测到多个 private ip, 会报错，可以用 -advertise 指定一个ip.</p>
<pre><code>// config.json , 指定 DNS port
{
    "recursors" : [ "8.8.8.8" ],
    "ports" : {
        "dns" : 53
    }
}

sudo docker run -d --name=consul --net=host -v $PWD/config.json:/config/config.json gliderlabs/consul-server -bootstrap -advertise=172.28.128.3 

curl 172.28.128.3:8500/v1/catalog/services</code></pre>
<h2>Start Registrator</h2>
<p>启动 registrator, 因为需要调用docker api， 所以需要把docker.sock 映射到容器内部，如果你使用了tcp， 那么需要设置对应的url。 </p>
<p>如果你希望上报容器内部ip:port, 那么需要在启动参数中加入 <code>-internal=true</code>, 这样注册的 Service, 都是容器内部的ip, 而port对于同一个service而言，一般是固定的，例如 一个hello服务的两个实例分别为 10.10.1.12:9090, 10.10.1.13:9090. 这样的话，就需要配置一个容器跨host的网络方案，例如 flannel, 等。 可以参考上一篇 <a href="https://segmentfault.com/a/1190000007585313">Flannel with Docker</a></p>
<p>为了简便测试，这里就不配置flannel了。<code>-ip</code>是指定注册service时候使用的ip，建议要指定，选取当前机器的内网 private ip即可。我这里是 <code>172.28.128.3</code>.</p>
<pre><code>sudo docker run -d --name=registrator --volume=/var/run/docker.sock:/tmp/docker.sock gliderlabs/registrator:latest -ip=172.28.128.3 consul://172.28.128.3:8500 </code></pre>
<h2>Start service</h2>
<p>启动服务，这里需要注意的是这些环境变量，作用是 override Registrator的默认值，见名知意，在 registrator 文档中有详细介绍。例如 <code>SERVICE_9090_NAME</code> 就是指 端口为 9090 的service 的 name。</p>
<p>需要注意的是 tags 这个字段，<code>urlprefix-/foo,hello</code>, 这里 <code>urlprefix-</code> 是 gateway 的一种配置，意思为 把访问 /foo 为前缀的请求转发到当前应用来。他能够匹配到例如 <code>/foo/bar</code>, <code>footest</code>, 等。如果你想加上域名的限制，可以这样 <code>urlprefix-mysite.com/foo</code>。 后面还有一个 <code>hello</code>, 作用是给这个service打一个标记，可以用作查询用。</p>
<pre><code>sudo docker run -d -P -e SERVICE_9090_CHECK_HTTP=/foo/healthcheck -e SERVICE_9090_NAME=hello -e SERVICE_CHECK_INTERVAL=10s -e SERVICE_CHECK_TIMEOUT=5s -e SERVICE_TAGS=urlprefix-/foo,hello silentred/alpine-hello:v2

curl 172.28.128.3:8500/v1/catalog/services
//现在应该能看到刚启动的hello服务了
{"consul":[],"hello":["urlprefix-mysite.com/foo","hello","urlprefix-/foo"]}</code></pre>
<p>测试 DNS</p>
<pre><code>sudo yum install bind-utils
dig @172.28.128.3 hello.service.consul SRV</code></pre>
<p>可以设置 /etc/resolv.conf</p>
<pre><code>nameserver 172.28.128.3
search service.consul</code></pre>
<p>这样无论在容器内部，还是外部都可以直接解析 sevice 名， 例如：</p>
<pre><code>[vagrant@localhost ~]$ ping hello
PING hello.service.consul (172.28.128.3) 56(84) bytes of data.
64 bytes from localhost.localdomain.node.dc1.consul (172.28.128.3): icmp_seq=1 ttl=64 time=0.016 ms

[vagrant@localhost ~]$ sudo docker exec -it fdde1b8247b8 bash
bash-4.4# ping hello
PING hello (172.28.128.6): 56 data bytes
64 bytes from 172.28.128.6: seq=0 ttl=63 time=0.361 ms</code></pre>
<h2>Start Gateway</h2>
<p>前端Gateway 根据 consul中注册的 service，生成对应的路由规则，把流量分发到各个节点。 这个项目还有一个 ui 管理 route信息，端口为 9998。</p>
<p>创建一个配置文件 fabio.properties</p>
<pre><code>registry.consul.addr = 172.28.128.3:8500</code></pre>
<p>在当前目录运行</p>
<pre><code>docker run -d -p 9999:9999 -p 9998:9998 -v $PWD/fabio.properties:/etc/fabio/fabio.properties magiconair/fabio</code></pre>
<p>测试gateway:</p>
<pre><code>curl 172.28.128.3:9999/foo/bar
curl 172.28.128.3:9999/foo/bar -H "Host: mysite.com"</code></pre>
<p><img data-src="/img/bVF3Cb?w=1749&amp;h=654"></p>
<h2>Health Check</h2>
<pre><code>sudo ifdown eth1

curl http://localhost:8500/v1/health/state/critical

[
    {
        "Node":"localhost.localdomain",
        "CheckID":"service:afa2769cd049:loving_shannon:9090",
        "Name":"Service 'hello' check",
        "Status":"critical",
        "Notes":"",
        "Output":"Get http://172.28.128.6:32768/foo/healthcheck: net/http: request canceled while waiting for connection (Client.Timeout exceeded while awaiting headers)",
        "ServiceID":"afa2769cd049:loving_shannon:9090",
        "ServiceName":"hello",
        "CreateIndex":379,
        "ModifyIndex":457
    }
]

sudo ifup eth1</code></pre>
<p>在启动 consul的时候，我们使用了<code>-ui</code> 参数，我们可以在 <code>172.28.128.3:8500/ui</code> 访问到consul的web ui管理界面，看到各个服务的状态.</p>
<p><img data-src="/img/bVF3BX?w=2336&amp;h=929"></p>
<h2>对比</h2>
<p>注册容器外IP：<br>每个注册的service的port都是变化的，并且因为映射内部port到了host，外部可以随意访问，私密性较弱。</p>
<p>注册容器内IP：<br>每个注册的service的port都是固定的，只能从容器内部访问。如果用 flannel，可能有一些性能损失。</p>
</body></html>
                </div>
                                                
                <div class="clearfix mt10">

                    <ul class="article-operation list-inline pull-left">
                        <li><a href="/a/1190000007601338" class="text-muted">7 小时前发布</a></li>
                                                                                                                            <li class="dropdown js__content-ops" data-module="article"
                                data-id="1190000007601338"
                                data-typetext="文章">
                                <a href="javascript:void(0);" class="dropdown-toggle text-muted" data-toggle="dropdown">更多<b
                                            class="caret"></b></a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a href="#911"
                                           data-toggle="modal"
                                           data-target="#911"
                                           data-action="report"
                                        >举报</a></li>
                                                                            
                                                                                                                        
                                        
                                                                    </ul>
                            </li>
                                            </ul>
                </div>
                <div class="mt10 text-center"><button type="button" id="mainLike" data-id="1190000007601338"
                                    class="btn btn-success btn-lg mr15 ">
                                0 推荐
                            </button><button type="button" id="mainBookmark" data-type="article" data-id="1190000007601338"
                                    class="btn btn-default btn-lg mr15 ">
                                收藏
                            </button></div>
                                    <div class="recommend-post pt30 mt40 mb30 border-top">
                        <div class="row">
                            <div class="col-md-8">
                                                                    <h4 class="mt0">你可能感兴趣的文章</h4>
                                    <ul class="widget-links list-unstyled">
                                                                                    <li class="widget-links__item">
                                                <a href="/a/1190000003783603"
                                                   title="Red Hat: API层是微服务架构成功的关键">Red Hat: API层是微服务架构成功的关键</a>
                                                <small class="text-muted">
                                                    2 收藏，557
                                                    浏览
                                                </small>
                                            </li>
                                                                                    <li class="widget-links__item">
                                                <a href="/a/1190000007586574"
                                                   title="史上最全Docker资料推送  ▎ Docker小白进阶大神计划">史上最全Docker资料推送  ▎ Docker小白进阶大神计划</a>
                                                <small class="text-muted">
                                                    28
                                                    浏览
                                                </small>
                                            </li>
                                                                                    <li class="widget-links__item">
                                                <a href="/a/1190000006875435"
                                                   title="Docker 实践（四）：Beta 环境容器化">Docker 实践（四）：Beta 环境容器化</a>
                                                <small class="text-muted">
                                                    14 收藏，894
                                                    浏览
                                                </small>
                                            </li>
                                                                            </ul>
                                                            </div>
                            <div class="col-md-4">
                                                            </div>
                        </div>

                    </div>
                                <!-- <ul class="list-unstyled text-muted mt30">
                                        <li>上一篇：<a href="/a/1190000007585313">Flannel with Docker</a></li>
                                                        </ul> -->

                <h2 class="h4 post-comment-title">讨论区</h2>
                <div class="widget-comments" id="comment-1190000007601338" data-id="1190000007601338">
            <div class="widget-comments__item hover-show" id="1050000007605201">
            <div class="votes widget-vote">
                <button class="like" data-id="1050000007605201" type="button"
                    data-do="like" data-type="comment"></button>
                <span class="count">+0</span>
            </div>
            <div class="comment-content">
                                                <div class="content fmt">
                    <p>OK</p>
                </div>
                <p class="comment-meta">
                    <a href="/c/1050000007605201" class="text-muted"></a>
                    <a href="/u/xiatian_58382f75a6026"
                       class="commentUser"
                       data-userid="1030000007604361"
                       data-username="夏天"
                       data-userslug=""
                       data-useravatar="">
                        <strong>夏天</strong>
                    </a>
                    &middot;
                    1 分钟前

                <span class="pull-right commentTools hover-show-obj">
                                                                <a href="javascript:void(0);" class="commentEdit ml10" data-id="1050000007605201">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                                                                <a href="javascript:void(0);" class="commentDel ml10" data-id="1050000007605201"
                            data-username="夏天">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                                                        </span>
                </p>
            </div>
        </div>
                <a href="javascript:void(0);" class="comments showMoreComments" data-id="1190000007601338"
       data-target="#comment-1190000007601338">展开评论</a>

    <div class="widget-comments__form row hidden">
        
                                                <form class="clearfix" method="POST" >
                        <div class="form-group mb0 widget-comments__form--input">
                            <input name="id" type="hidden" value="1190000007601338"/>
                            <textarea rows="1"                                       name="text"
                                      class="form-control mono" id="commentText-1190000007601338" data-id="1190000007601338"
                                      placeholder="使用评论询问更多信息或提出修改意见，请不要在评论里回答问题"></textarea>

                        </div>
                        <div class="widget-comments__btn">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-default postComment"
                                        data-id="1190000007601338"
                                         >提交评论
                                </button>
                                <span class="widget-comments__btn--tips"><a href="javascript:void(0);"
                                    class="toggle-comment-helper"
                                    title="语法提示">
                                <i class="fa fa-question-circle"></i>
                            </a></span>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible mb0 mt10 fmt comment-helper" data-rank="0" style="display:none;" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="right:0;"><span aria-hidden="true">&times;</span></button>
                            评论支持部分 Markdown 语法：<code>**bold**</code> <code>_italic_</code>
                            <code>[link](http://example.com)</code> <code>> 引用</code> <code>`code`</code> <code>-
                            列表</code>。<br>同时，被你 @ 的用户也会收到通知
                        </div>
                    </div>
                
            
        </div><!-- /.widget-comments__form -->
            </div><!-- /.widget-comments -->

    

                
            </div><!-- /.main -->


            <div class="col-xs-12 col-md-3 side">
                <div class="sfad-sidebar">
      <div class="sfad-item">
    <ins data-revive-zoneid="2" data-revive-block="1" data-revive-target="_blank" data-revive-ct0='1480086907' data-revive-id="0042ddc520dc895b7aa784fe6f9339bd"></ins>
    <button class="close" type="button" aria-hidden="true">&times;</button>
</div>

  </div>


                <div class="widget-box widget-box--blog-info">
                    <div class="blog__sidebar-author">
                                                        <button type="button"
                                        class="btn btn-sm btn-success follow-user ml10 pull-right"
                                        data-do="follow"
                                        data-type="user"
                                        data-id="1030000002604351">关注作者
                                </button>
                            
                        <div class="article__widget--author">
                        <a href="/u/silentred">
                            <img class="avatar-40" src="https://sfault-avatar.b0.upaiyun.com/132/731/1327316133-558556c424cd8_big64" alt="一堆好人卡">
                        </a>
                        <a class="article__widget-author-name" href="/u/silentred">
                            <strong>一堆好人卡</strong>
                        </a>
                        <p class="article__widget-author-text-muted mb0">
                            <span>1.6k 声望</span>

                        </p>





                    </div>



                    </div>
                    <div class="blog__sidebar-blog-name">
                        <p class="article__widget-author-text-muted mt15 mb5">发表于于专栏</p>
                        <h4 class="fz16"><a href="/blog/silentred">JasonCodes</a></h4>
                        <p class="article__widget-author-desc">Laravel框架详解</p>

                        <p>
                            <span class="article__widget-author-text-muted">26 人关注</span>
                            
                                                                    <button type="button mb20"
                                            class="btn btn-sm btn-default follow-article pull-right"
                                            data-do="follow"
                                            data-type="blog"
                                            data-id="1200000002921470">关注专栏
                                    </button>
                                
                                                </p>

                    </div>








                </div>


                
                    <div data-type="widget" data-api="/api/bookmarkArchive/hots" data-api-overwrite="/api/bookmarkArchive/1190000007601338/related">
        <script type="text/template">
            <div class="widget-box widget-box--bookmark no-border">
                <h4 class="widget-box__title">相关收藏夹 <a id="widgetBookmarkRefresh" class="userstab pull-right"
                                                          href="javascript:;">换一组</a></h4>
                <ul class="widget-links list-unstyled media">
                    <% _.each(data,function(d){ %>
                    <li class="widget-links__item">
                        <img class="pull-left pattern pattern-<%= d.id%19 %> mr10" src="https://sf-static.b0.upaiyun.com/v-5837a251/global/img/pattern/<%= d.id%10 ? d.id%10 : 10 %>.svg" width="32">
                        <div class="media-body">
                            <a target="_blank" class="ellipsis mr0" href="<%- d.url %>"><%= d.name %></a>
                            <p class="mb0">
                                <span><%- d.num %></span> 个条目 <span class="division">|</span> <span><%- d.followers %></span> 人关注
                            </p>
                        </div>
                    </li>
                    <% }) %>
                </ul>
            </div>
        </script>
    </div>


                <div class="widget-share__full" data-text="基于容器的后端服务架构"
 data-url="https://segmentfault.com/a/1190000007601338?share_user=1030000007604361" data-shorturl="http://sfau.lt/b5F3Co"></div>

                <div class="post-nav hidden-xs">
                    <div class="panel panel-default widget-outline">
                        <div class="panel-heading">文章目录</div>
                        <div class="panel-body">
                            <div class="nav-body">
                                <div class="highlight-title"></div>
                                <ul class="articleIndex"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.side -->
        </div>
    </div>
</div>

<div id="shareToWeiboModal" class="modal" tabindex='-1'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">分享</h4>
            </div>
            <div class="modal-body">
                <p class="sfModal-content">
                    分享到微博？
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default dont-likeweibo" data-dismiss="modal">取消</button>
                <a href="" id="shareLink" class="btn btn-primary done-btn" target="_blank"
                   onclick="$('#shareToWeiboModal').modal('hide')">分享</a>
            </div>
        </div>
    </div>
</div>


<div class="modal widget-911" id="911" tabindex='-1'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" type="button">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title"><span data-model="action"></span><span data-model="type"></span></h4>
      </div>
      <div class="modal-body">
        <form id="reportForm">
          <!-- 后台返回信息 -->
          <p class="alert alert-warning" data-model="returnMsg"></p>
          <div data-role="base">
            <p>
              <strong class="required">我要<span data-model="action"></span>该<span data-model="type"></span>，理由是：</strong>
            </p>
            <ul class="list-unstyled" data-model="list"></ul>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default pull-left" type="button" data-role="back" style="display:none">返回重选</button>
                <button class="btn btn-default" data-dismiss="modal" type="button">取消</button>
        <button class="btn btn-primary" data-role="submit" type="button">提交</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<footer id="footer">
    <div class="container">
        <div class="row hidden-xs">
            <dl class="col-sm-2 site-link">
                <dt>网站相关</dt>
                <dd><a href="/about">关于我们</a></dd>
                <dd><a href="/tos">服务条款</a></dd>
                <dd><a href="/faq">帮助中心</a></dd>
                <dd><a href="/repu">声望与权限</a></dd>
                <dd><a href="/markdown">编辑器语法</a></dd>
                <dd><a href="//weekly.segmentfault.com/">每周精选</a></dd>
                <dd><a href="/app">App 下载</a></dd>
                <dd><a href="/community">社区服务中心</a></dd>
            </dl>
            <dl class="col-sm-2 site-link">
                <dt>联系合作</dt>
                <dd><a href="/contact">联系我们</a></dd>
                <dd><a href="/hiring">加入我们</a></dd>
                <dd><a href="/link">合作伙伴</a></dd>
                <dd><a href="/press">媒体报道</a></dd>
                <dd><a href="https://board.segmentfault.com/">建议反馈</a></dd>
                            </dl>
            <dl class="col-sm-2 site-link">
                <dt>常用链接</dt>
                                                <dd><a href="//chrome.google.com/webstore/detail/segmentfault-%E7%AC%94%E8%AE%B0/pjklfdmleagfaekibdccmhlhellefcfo" target="_blank">笔记插件: Chrome</a></dd>
                                                                <dd><a href="//addons.mozilla.org/zh-CN/firefox/addon/sf-note-ext/" target="_blank">笔记插件: Firefox</a></dd>
                                                                <dd>订阅：<a href="/feeds">问答</a> / <a href="/feeds/blogs">文章</a></dd>
                                                                <dd><a href="//mirrors.segmentfault.com/" target="_blank">文档镜像</a></dd>
                                                                <dd><a href="//segmentfault.com/blog/interview" target="_blank">社区访谈</a></dd>
                                                                <dd><a href="//segmentfault.com/d-day" target="_blank">D-DAY 技术沙龙</a></dd>
                                                                <dd><a href="//segmentfault.com/hackathon" target="_blank">黑客马拉松 Hackathon</a></dd>
                                                                <dd><a href="//namebeta.com/" target="_blank">域名搜索注册</a></dd>
                                            </dl>
            <dl class="col-sm-2 site-link">
                <dt>关注我们</dt>
                                <dd><a href="//github.com/SegmentFault" target="_blank">Github</a></dd>
                                <dd><a href="//twitter.com/segment_fault" target="_blank">Twitter</a></dd>
                                <dd><a href="http://weibo.com/segmentfault" target="_blank">新浪微博</a></dd>
                                <dd><a href="//segmentfault.com/blog/segmentfault_team" target="_blank">团队日志</a></dd>
                                <dd><a href="//segmentfault.com/blog/segmentfault" target="_blank">产品技术日志</a></dd>
                                <dd><a href="//segmentfault.com/blog/community_admin" target="_blank">社区运营日志</a></dd>
                                <dd><a href="//segmentfault.com/blog/segmentfault_news" target="_blank">市场运营日志</a></dd>
                            </dl>
            <dl class="col-sm-4 site-link" id="license">
                <dt>内容许可</dt>
                <dd>除特别说明外，用户内容均采用 <a rel="license" target="_blank" href="http://creativecommons.org/licenses/by-sa/3.0/cn/">知识共享署名-相同方式共享 3.0 中国大陆许可协议</a> 进行许可
                </dd>
                <dd>本站由 <a target="_blank" href="https://www.upyun.com/?utm_source=segmentfault&utm_medium=link&utm_campaign=upyun&md=segmentfault">又拍云</a> 提供 CDN 存储服务
                </dd>
            </dl>
        </div>
        <div class="copyright">
            Copyright &copy; 2011-2016 SegmentFault. 当前呈现版本 16.11.22<br>
            <a href="http://www.miibeian.gov.cn/" rel="nofollow">浙ICP备 15005796号-2</a> &nbsp;
            <a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=33010602002000" rel="nofollow">浙公网安备 33010602002000号</a>
        </div>
        <p class="text-center">
            <a class="js__view--selector hidden-sm hidden-md hidden-lg" data-action="mobile" href="javascript:;">移动版</a>
            <a class="js__view--selector hidden-sm hidden-md hidden-lg" data-action="desktop" href="javascript:;">桌面版</a>
        </p>
    </div>
</footer>

<div id="fixedTools" class="hidden-xs hidden-sm">
    <a id="backtop" class="hidden border-bottom" href="#">回顶部</a>

    <div class="qrcodeWraper">
        <a href="/app#qrcode"><span class="glyphicon glyphicon-qrcode"></span></a>
        <img id="qrcode" class="border" alt="sf-wechat" src="https://sf-static.b0.upaiyun.com/v-5837a251/page/img/app/appQrcode.png">

        <p class="qrcode-text">扫扫下载 App</p>
    </div>
</div>

<div class="app-promotion-bar">
    <a href="javascript:;"><i class="fa fa-close close"></i></a>
    <div class="icon"></div>
    <h5 class="title h5">SegmentFault</h5>
    <p class="describe">一起探索更多未知</p>
    <a class="download-btn btn btn-sm btn-primary" href="/app#qrcode">下载 App</a>
</div>

<script id="loginModal" type="text/template">
    <div class="row bg-white login-modal">
        <div class="col-md-4 col-sm-12 col-md-push-7 login-wrap">
            <h1 class="h4 text-muted login-title">用户登录</h1>
            <form action="/api/user/login" method="POST" role="form" class="mt30">
                <div class="form-group">
                    <label for="username" class="control-label">手机号 或 Email</label>
                    <input type="text" class="form-control" name="username" required placeholder="11 位手机号 或 Email"
                           autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="control-label">密码</label><span class="pull-right"><a
                                href="/user/forgot">忘记密码</a></span>
                    <input type="password" class="form-control" name="password" required placeholder="密码">
                </div>
                <div class="form-group clearfix">
                    <div class="checkbox pull-left">
                        <label><input name="remember" type="checkbox" value="1" checked> 记住登录状态</label>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right pl20 pr20"
                            onclick='ga("send", "event", "email login button", "clicked", "login modal");'>登录
                    </button>
                </div>
            </form>
            <p class="h4 text-muted visible-xs-block h4">快速登录</p>
            <div class="widget-login mt30">
                <p class="text-muted mt5 mr10 pull-left hidden-xs">快速登录</p>
                <a href="/user/oauth/google" class=""
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "google"});'><span
                            class="icon-sn-google"></span> <strong class="visible-xs-inline">Google 账号</strong></a>
                <a href="/user/oauth/github" class=""
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "github"});");'><span
                            class="icon-sn-github"></span> <strong class="visible-xs-inline">Github 账号</strong></a>
                <a href="/user/oauth/weibo" class=""
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "weibo"});'><span
                            class="icon-sn-weibo"></span> <strong class="visible-xs-inline">新浪微博账号</strong></a>
                <a href="/user/oauth/qq" class=""
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "qq"});'><span
                            class="icon-sn-qq"></span> <strong class="visible-xs-inline">QQ 账号</strong></a>
                <a href="/user/oauth/weixin" class=""
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "qq"});'><span
                            class="icon-sn-weixin"></span> <strong class="visible-xs-inline">微信账号</strong></a>
                <a href="/user/oauth/linkedin" class=""
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "linkedin"});'><span
                            class="icon-sn-linkedin"></span> <strong class="visible-xs-inline">LinkedIn 账号</strong></a>
                <span id="loginShowMore" style="cursor: pointer" class="mb5"><span class="icon-sn-dotted"></span><strong
                            class="visible-xs-inline">•••</strong></span>
                <a href="/user/oauth/twitter" class=" hidden"
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "twitter"});'><span
                            class="icon-sn-twitter"></span> <strong class="visible-xs-inline">Twitter 账号</strong></a>
                <a href="/user/oauth/facebook" class=" hidden"
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "facebook"});'><span
                            class="icon-sn-facebook"></span> <strong class="visible-xs-inline">Facebook 账号</strong></a>
                <a href="/user/oauth/douban" class=" hidden"
                   onclick='ga("send", "event", "3rd login button", "clicked", "login modal", {media: "douban"});'><span
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
                        <input type="phone" class="form-control mb15" name="phone" required placeholder="仅支持大陆手机号"
                               autocomplete="off">
                        <div class="input-group"><input name="code" type="text"
                                                        class="form-control js-user-login__phone-code-value"
                                                        placeholder="短信验证码">
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
                    <div class="mt10"><a id="loginReloadCaptcha" href="javascript:void(0)"><img
                                    data-src="/user/captcha?w=240&h=50" class="captcha" width="240" height="50"/></a>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="checkbox pull-left">
                        同意并接受<a href="/tos" target="_blank">《服务条款》</a>
                    </div>
                    <button type="submit" class="btn btn-primary pl20 pr20 pull-right"
                            onclick='ga("send", "event", "email register button", "clicked", "login modal");'>注册
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center text-muted mt30">
    </div>
</script>



<script>
    (function (w) {
        w.SF = {
            staticUrl: "https://sf-static.b0.upaiyun.com/v-5837a251"
        };
        w.SF.token = (function () {
    var _RnegPp = //'Fn'
'd26'+/* 'JI'//'JI' */''+'28'//'f'
+'89'//'9'
+//'YQl'
'5b'+'eb2'//'M'
+//'sUm'
'a'+//'2'
'3'+'f7c'//'jD3'
+//'IM'
'a7'+/* 'KY'//'KY' */''+//'8gn'
'f6e'+'c'//'15u'
+//'5'
'8c0'+'c'//'FN'
+/* 'O'//'O' */''+''///*'i7'*/'i7'
+'326'//'bfC'
+'wy'//'wy'
+//'Wd'
'1'+'Zz3'//'Zz3'
+/* 'WvP'//'WvP' */''+//'rN'
'0', _dcX0uF = [[30,32],[31,34]];

    for (var i = 0; i < _dcX0uF.length; i ++) {
        _RnegPp = _RnegPp.substring(0, _dcX0uF[i][0]) + _RnegPp.substring(_dcX0uF[i][1]);
    }

    return _RnegPp;
})();;
    })(window);

                var lock = {
        type: "",
        text: '',
        table: {"ban_post":[1,"\u4f60\u5df2\u7ecf\u88ab\u7981\u8a00, \u65e0\u6cd5\u8fdb\u884c\u6b64\u64cd\u4f5c, \u5982\u6709\u7591\u4e49\u8bf7\u63d0\u4ea4\u7533\u8bc9, \u6216\u8005\u53d1\u90ae\u4ef6\u5230pr@segmentfault.com"]}
    };
</script>

    <script crossorigin src="https://sf-static.b0.upaiyun.com/v-5837a251/3rd/assets.js"></script>
    <script crossorigin src="https://sf-static.b0.upaiyun.com/v-5837a251/blog/script/post.min.js"></script>

<script async src="//sponsor.segmentfault.com/asyncjs.php"></script>

<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-918487-8']);
    _gaq.push(['_trackPageview']);
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            
        

                        

    ga('create', 'UA-918487-8', 'auto', {
        'userID'
    : 1030000007604361,
        'createdTime'
    : 1480077173,
        'now'
    : 1480086907 });
    ga('set', 'dimension1', 'new_registed_visitor');
    ga('send', 'pageview');

</script>

<script>
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?e23800c454aa573c0ccb16b52665ac26";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>


</body>
</html>