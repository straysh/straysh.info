<style rel="stylesheet/scss" lang="scss">
  .site-footer {
    clear: both;
    padding-top: 40px !important;
    padding-bottom: 20px !important;
    font-size: 13px;
    text-align: center;
    h2{
      color: rgb(51, 51, 51);
      font-size: 30px;
      margin-bottom: 10.5px;
      margin-top: 21px;
      font-weight: 700;
      line-height: 1.2;
    }
  }
</style>

<template>
  <footer class="site-footer" id="site-footer">
    <h2 class="epsilon">创建和维护</h2>
    <ul>
      <li><a href="/">Jobkhan Chao</a></li>
    </ul>

    <h2 class="epsilon">个人简介</h2>
    <ul>
      <li><router-link to="/profile">曹庭汉</router-link></li>
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
      <a href="/" target="_blank">Straysh's Blog</a>
      |
      <a href="mailto:jobhancao@gmail.com">给我留言</a>
      <!--|-->
      <!--<div class="langSet" onclick="return false;" onmouseover="$(this).addClass('btm_link')" onmouseout="$(this).removeClass('btm_link')">-->
        <!--<a href="?">Language<span class="btn_arr"><span><em>◆</em></span></span></a>-->
        <!--<div class="subNav" style="display:none;">-->
          <!--<p><a href="?lang=zh_CN " data-flag="3">简体中文</a></p>-->
          <!--<p class="second"><a href="?lang=zh_CHT" data-flag="1">繁體中文</a></p>-->
          <!--<p class="last"><a href="?lang=en_US" data-flag="2">English</a></p>-->
          <!--<p></p>-->
        <!--</div>-->
      <!--</div>-->
      <br/>
      <span>Copyright © 2012 - 2016 Straysh. All Rights Reserved</span>
    </div>
  </footer>
</template>