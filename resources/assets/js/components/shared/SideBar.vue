<style rel="stylesheet/scss" lang="scss">
.sui-sidebar {
  position: fixed;
  width: 4.5rem;
  z-index: 1049;
  overflow: visible;
  /*visibility: hidden;*/
  .dropdown{
    display: flex;
    flex-flow: column wrap;
  }
  .nav-user {
    position: absolute;
    bottom: 0;
    padding-bottom: 5px;
    width: 100%;
  }
  .nav-item{
    display: flex;
    justify-content: center;
    flex-direction: column;
    width: 100%;
    height: 3em;
    font-size: 16px;
    line-height: 25px;
    color: #999999;
    text-shadow: 0 1px 0 black;
    text-align: center;
    &.logo {
      font-size: 18px;
      color: white;
    }
    &.signin{width: 100%;}
  }
}

.sui-sidebar-expanded {
  left: 0;
  top: 0;
  height: 100%;
  background: #2a2a2a;
  .dropdown a {
    &:hover,&:active,&.active{
      color: white;
      background-color: #e78170;
      text-shadow: 0 1px 0 #de533a;
    }
    &:hover{
      background-color: #f49484;
      text-decoration: none;
    }
  }
  .nav-user a{
    &:hover,&.active{
      color: #eeeeee;
    }
  }
}
</style>

<template>
  <div class="sui-sidebar sui-sidebar-expanded">
    <div class="dropdown">
      <router-link to="/" class="nav-item logo" activeClass="active">
        <i class="fa fa-home"></i>
        <span class="title">Straysh</span>
      </router-link>
      <router-link to="/category" class="nav-item" activeClass="active">
        <i class="fa fa-th"></i>
        <span class="title hidden">Category</span>
      </router-link>
    </div>
    <div class="nav-user">
      <!--<a href="#view-mode-modal" data-toggle="modal"><i class="fa fa-font"></i><span class="title">显示模式</span></a>-->
      <router-link to="/login" class="nav-item signin" activeClass="active">
        <i class="fa fa-sign-in"></i><span class="title hidden">登录</span>
      </router-link>
    </div>
  </div>
</template>