<style rel="stylesheet/scss" lang="scss">
.site-header{
  text-align: center;
}
#welcome{font-size: 36px;}
</style>

<template>
  <div>
    <header class="site-header" id="site-header">
      作者：<router-link to="/profile">Straysh</router-link>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://t.qq.com/Straysh" target="_blank">关注我的微博</a>
      <!--<iframe src="http://follow.v.t.qq.com/index.php?c=follow&a=quick&name=straysh&style=5&t=1354873775992&f=1" marginwidth="0" marginheight="0" allowtransparency="true" frameborder="0" height="24" scrolling="auto" width="178"></iframe>-->
    </header>
    <h1 id="welcome">Welcome</h1>
    <p>Oct 2017: 使用Laravel5.4+Vue2.0重构, 并重新设计了文章发布流程, 文章写完即自动上线发布。</p>
    <p>Feb 2015: 后端使用Laravel重构。</p>
    <p>2 Oct 2014: 之前用vim wiki写文章，效率提高不少。但是在多个系统之间切换工作时，拷贝配置文件着实纠结。这次重新实现了发布流程，使用markdown语法和php的markdown解析库。</p>
    <p>9 Mar 2013: 博客重开。用于学习、交流和日常记录。博客后端框架使用的是YII version 1.1.12。</p>
  </div>
</template>