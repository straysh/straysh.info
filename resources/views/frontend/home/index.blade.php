@extends("frontend.layouts.master_v2")

@section("contents")
    <header class="site-header" id="site-header">
        作者：<a href="/profile/index" target="_blank">Straysh</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://t.qq.com/Straysh" target="_blank">关注我的微博</a>
        <iframe src="http://follow.v.t.qq.com/index.php?c=follow&a=quick&name=straysh&style=5&t=1354873775992&f=1" marginwidth="0" marginheight="0" allowtransparency="true" frameborder="0" height="24" scrolling="auto" width="178"></iframe>
    </header>
    <h1 id="welcome">Welcome</h1>
    {{--<a href="http://t.qq.com/Straysh" target="_blank"><img src="http://v.t.qq.com/sign/Straysh/2d350a63101544ea4d5287826dfc771d036928fd/1.jpg" width="380" height="100" /></a>--}}
    <a class="qq-zone-card" href="http://user.qzone.qq.com/369310239" target="_blank"><img src="http://r.qzone.qq.com/cgi-bin/cgi_get_user_pic?openid=00000000000000000000000019D3ED47&pic=3.jpg&key=77193caf23493b9d90c26812b4b17115" style="width:380px;height:100px;"></a>
    <p>Feb 2015: 后端使用Laravel重构。</p>
    <p>2 Oct 2014: 之前用vim wiki写文章，效率提高不少。但是在多个系统之间切换工作时，拷贝配置文件着实纠结。这次重新实现了发布流程，使用markdown语法和php的markdown解析库。</p>
    <p>9 Mar 2013: 博客重开。用于学习、交流和日常记录。博客后端框架使用的是YII version 1.1.12。</p>
    @include("frontend.layouts._partial.footer")
@stop

@section("modal")
    @parent
    <script>
        UI.$CONFIG.currentPage = 'homepage';
    </script>
    {!! ViewHelper::registerRequirejs('app/v2') !!}
@stop