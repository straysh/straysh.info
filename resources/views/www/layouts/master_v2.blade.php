<!doctype html>
<html lang="en">
<head>
    @include("www.layouts._partial.head")
    @section('head')
        @if(config('app.debug'))
            {!! ViewHelper::registerCssScript('app') !!}
            {!! ViewHelper::registerCssScript('test') !!}
        @else
            {!! ViewHelper::registerCssScript('app') !!}
        @endif
    @show
</head>
<body class="{{ $bodyClass or "output" }}" id="{{ $bodyId or "main-container" }}" role="main" ontouchstart="" data-ctrl-name="pageview" data-dpr="2" >
<div class="navbar navbar-jianshu expanded">
    <div class="dropdown">
        <a class="active logo" href="/">
            <b>S</b>{{--<i class="fa fa-home hidden"></i>--}}<span class="title hidden">首页</span>
        </a>
        <a href="javascript:void 0;">
            <i class="fa fa-th"></i><span class="title hidden">Category</span>
        </a>
    </div>
    <div class="nav-user">
        {{--<a href="#view-mode-modal" data-toggle="modal"><i class="fa fa-font"></i><span class="title">显示模式</span></a>--}}
        <a class="signin" href="javascript:void 0;">
            <i class="fa fa-sign-in"></i><span class="title hidden">登录</span>
        </a>
    </div>
</div>
<div class="row-fluid">
    <div class="recommended">
        @if(isset($navMenuActive) && 'article-detail'!==$navMenuActive)
        <div class="span3 left-aside" style="background-image: url(/images/left_images/2.jpg)">
            {{--<div class="cover-img" style="background-image: url(/images/left_images/2.jpg)"></div>--}}
            <div class="nav-content">
                <h1>Straysh的后院</h1>
                <div class="introduce">
                    {!! $nag or "" !!}
                </div>
                <ul id="nav-menu" class="nav-menu">
                    <li class="menu-item {{ ViewHelper::navMenuActive("homepage", $navMenuActive) }}"><a href="/">首页</a></li>
                    <li class="menu-item {{ ViewHelper::navMenuActive("article-timeline", $navMenuActive) }}"><a href="/article/timeline">工作学习</a></li>
                    <li class="menu-item {{ ViewHelper::navMenuActive("essay", $navMenuActive) }}"><a href="/essay">随笔</a></li>
                    <li class="menu-item {{ ViewHelper::navMenuActive("timeline", $navMenuActive) }}"><a href="/life">杂记</a></li>
                    <li class="menu-item {{ ViewHelper::navMenuActive("profile", $navMenuActive) }}"><a href="/profile">关于博主</a></li>
                </ul>
                <div class="img-info">
                    <i class="fa fa-info"></i>
                    <div class="info">
                        Photo by <a target="_blank" href="javascript:void 0;">unsplash</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="span7 offset3 right-aside">
            @if(isset($navMenuActive) && 'article-detail'!==$navMenuActive)
            <div class="page-title">
                <ul class="recommened-nav navigation clearfix">
                    <li class="active">
                        <a data-pjax="true" href="javascript:void 0;">文章</a>
                    </li>
                    {{--<li>
                        <a data-pjax="true" href="/trending/now">发现</a>
                    </li>--}}
                    <li class="search">
                        <form class="search-form" target="_blank" action="#" accept-charset="UTF-8" method="get">
                            <input name="utf8" type="hidden" value="✓">
                            <input type="search" name="q" placeholder="搜索" class="input-medium search-query" onfocus="$(this).stop().animate({width: '300px'});" onblur="$(this).stop().animate({width:'150px'});">
                            <span class="search_trigger" onclick="$('form.search-form').submit();"><i class="fa fa-search"></i></span>
                        </form>
                    </li>
                </ul>
            </div>
            @endif
            <div id="list-container">
                @yield("contents")
            </div>
        </div>
    </div>
</div>

@section("modal")
    {!!
        ViewHelper::registerJsTemplate([

        ])
    !!}

    <script>
        var UI = window.UI || {};
        UI.$CONFIG = UI.$CONFIG || {};
        UI.api_host = '{{ ViewHelper::apiHost() }}';
        UI.web_host = '{{ ViewHelper::webHost() }}';
        UI.$CONFIG.Yuser = ({!! ViewHelper::json_encode(isset($yuser)?$yuser:[]) !!});
        UI.$CONFIG.Ouser = ({!! ViewHelper::json_encode(isset($ouser)?$ouser:[]) !!});
        UI.$CONFIG.pageParams = ({!! ViewHelper::json_encode(isset($pageParams)?$pageParams:[]) !!});
        UI.$CONFIG.singPack = ({!! ViewHelper::json_encode(isset($singPack)?$singPack:[]) !!});
    </script>
    @if(!config('app.debug'))
        <script>
            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "//hm.baidu.com/hm.js?05a9120284c9d52abbb86d83442f5413";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    @endif
@show
</body>
</html>