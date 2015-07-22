<!DOCTYPE html>
<html lang="en"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="description" content="PHP学习和交流，以及日常笔记">
    <meta name="robots" content="index,follow,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="{{ asset("/css/app".(config('app.debug')?"":"_min").".css") }}">
    <script type="text/javascript" src="/js/require.js" data-main="{{ asset( "/js/main".(config('app.debug')?"":"_min") ) }}"></script>
    @yield('head')
    <title>Straysh's Blog</title>
    <link rel="icon" href="/favicon.ico" >
</head>

<body>

@section("nav")
    <nav class="site-navigation">
        <div class="build-date">Last Updated: <?php echo date('r', filectime(public_path().'/frontend/index.php'));?></div>
        {{ ViewHelper::renderSideTree() }}
    </nav>
@show

<div class="site-content" >
    <a class="fork-me" href="https://github.com/straysh/straysh.info">
        <img style="position: absolute; top: 0; right: 0; border: 0 none;" src="/images//forkme_right_darkblue_121621.png" alt="Fork me on GitHub">
    </a>
    @yield("content")

    <footer class="site-footer" id="site-footer">
        <h2 class="epsilon">创建和维护</h2>
        <ul>
            <li><a href="{{ Request::url() }}">jobhancao Chao</a></li>
        </ul>

        <h2 class="epsilon">个人简介</h2>
        <ul>
            <li><a href="/profile/index">曹庭汉</a></li>
        </ul>

        <h2 class="epsilon">电子邮件</h2>
        <ul>
            <li><a href="mailto:jobhancao@gmail.com">jobhancao@gmail.com</a></li>
        </ul>

        <h2 class="epsilon">现居地</h2>
        <ul class="mbd">
            <li>北京 朝阳</li>
        </ul>

        <h2 class="epsilon">友情链接</h2>
        <p>
            <a href="http://joke568.github.com" target="_blank">刘强</a>
            |
            <a href="http://www.itshipin.com/blog" target="_blank">阳光BLOG</a>
        </p>

        <div>
            <a href="{{ Request::url() }}" target="_blank">Straysh's Blog</a>
            |
            <a href="mailto:jobhancao@gmail.com">给我留言</a>
            |
            <div class="langSet" onclick="return false;" onmouseover="$(this).addClass('btm_link')" onmouseout="$(this).removeClass('btm_link')">
                <a href="?">Language<span class="btn_arr"><span><em>◆</em></span></span></a>
                <div class="subNav" style="display:none;">
                    <p><a href="?lang=zh_CN " data-flag="3">简体中文</a></p>
                    <p class="second"><a href="?lang=zh_CHT" data-flag="1">繁體中文</a></p>
                    <p class="last"><a href="?lang=en_US" data-flag="2">English</a></p>
                    <p></p>
                </div>
            </div>
            <br/>
            <span>Copyright © 2012 - 2015 Straysh. All Rights Reserved</span>
        </div>
    </footer>
</div>

@section("foot")
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
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253583555'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1253583555%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
@endif
@show
</body>
</html>
