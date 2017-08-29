<style rel="stylesheet/scss" lang="scss">
.sui-navbar{
  background:url(../../../images/nav_bg/2.jpg);
  h1,ul{margin:0;padding:0;}
  .nav-content{
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    color: #FFF;
    padding: 10%;
    background-color: rgba(0,0,0,0.7);
    h1{font-size: 30px;font-weight: bold;}
    box-sizing: border-box;
    .introduce {
      width: 90%;
      line-height: 25px;
      color: gray;
      font-size: 14px;
      border: 1px gray dashed;
      margin-top: 30px;
      padding: 20px;
      word-break: break-all;
    }

    .nav-menu{
      list-style: none;
      margin-top: 20px;
      li a{
        display: block;
        height: 50px;
        line-height: 50px;
        color: #fff;
        padding: 0 15px;
        border-bottom: 1px #4d4d4d solid;
        -moz-transition: all 0.3s;
        -o-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        &:hover{
          background-color: rgba(0,0,0,0.3);
          -moz-transform: translateX(20px);
          -ms-transform: translateX(20px);
          -webkit-transform: translateX(20px);
          transform: translateX(20px);
        }
      }
      li.active a{
        background-color: rgba(0,0,0,0.3);
        position: relative;
        &::after{
          content: '.';
          display: block;
          width: 0;
          height: 0;
          font-size: 0;
          border: 10px transparent solid;
          border-right-color: #fff;
          position: absolute;
          right: 0;
          top: 15px;
        }
      }
    }
  }

  .img-info {
    position: absolute;
    right: 0;
    bottom: 0;
    padding: 0;
    text-align: right;
    color: white;
    .info {
      position: absolute;
      bottom: 10px;
      right: 15px;
      width: 0;
      padding: 4px 0 4px;
      overflow: hidden;
      background: black;
      border-radius: 10px;
      line-height: 10px;
      text-align: center;
      font-size: 10px;
      font-style: italic;
      color: #b1b1b1;
      white-space: nowrap;
      a {
        color: #d5d5d5;
        font-style: normal;
        &:hover{color:#FFF}
      }
    }
  }
  .img-info:hover .info {
    width: auto;
    padding: 4px 14px 4px 12px;
    transition: all 0.2s cubic-bezier(0, 0.34, 0.71, 1.26) !important;
  }
  .fa-info {
    position: relative;
    width: 18px;
    height: 18px;
    display: inline-block;
    margin: 0 10px 10px 0;
    background: black;
    border-radius: 50%;
    color: #d5d5d5;
    font-size: 12px;
    line-height: 19px;
    text-align: center;
    z-index: 9;
  }
}
</style>
<template>
  <div class="sui-navbar">
    <!--<div class="cover-img" style="background-image: url(/images/left_images/2.jpg)"></div>-->
    <div class="nav-content">
      <h1>Straysh的后院</h1>
      <div class="introduce">
        妳是风中的叶，风起而走,我想去追，
        <br/>
        怎么抓的住?
      </div>
      <ul id="nav-menu" class="nav-menu">
        <router-link tag="li" to="/home" class="menu-item" activeClass="active"><a>首页</a></router-link>
        <router-link tag="li" to="/article" class="menu-item" activeClass="active" exact><a>工作学习</a></router-link>
        <router-link tag="li" to="/essay" class="menu-item" activeClass="active"><a>随笔</a></router-link>
        <router-link tag="li" to="/lifenote" class="menu-item" activeClass="active"><a>杂记</a></router-link>
        <router-link tag="li" to="/profile" class="menu-item" activeClass="active"><a>关于博主</a></router-link>
      </ul>
      <div class="img-info">
        <i class="fa fa-info"></i>
        <div class="info">
          Photo by <a target="_blank" href="javascript:void 0;">unsplash</a>
        </div>
      </div>
    </div>
  </div>
</template>