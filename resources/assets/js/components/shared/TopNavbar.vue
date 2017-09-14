<style rel="stylesheet/scss" lang="scss">
.page-title {
  position: fixed;
  top: 0;
  left: 34.5rem;
  right: 0;
  max-width: 1000px;
  box-sizing: border-box;
  background: white;
  border-width: 2px;
  padding-left: 20px;
  border-bottom: 2px solid #d9d9d9;
  font-size: 14px;
  z-index: 1;
  .navigation {
    padding: 0;
    margin: 0;
    border-bottom: none;
    list-style: none;
    text-align: center;
  }
  &>ul {
    a {
      padding: 15px;
      display: inline-block;
      color: #999999;
    }
    a:hover {
      background-color: #eeeeee;
      color: #555555;
    }
    .active {
      margin-bottom: -2px;
      border-bottom: 2px solid #555555;
      a {
        color: #555555;
      }
    }
  }
  li {
    line-height: 20px;
    float: left;
    a {
      transition: all 0.3s;
    }
  }
  .search_trigger {
    display: inline-block;
    position: relative;
    vertical-align: text-top;
    z-index: 2;
    .fa-search {
      top: 3px;
      right: 15px;
      display: inline-block !important;
      position: absolute;
      font-size: 12px;
      cursor: pointer;
    }
  }
  .input-medium {
    width: 150px;
  }
  input[type="search"] {
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    -webkit-appearance: textfield;
  }
  .search {
    float: right;
    margin-top: 10px;
    input{
      display: inline-block;
      height: 20px;
      padding: 4px 6px;
      margin-bottom: 10px;
      font-size: 14px;
      line-height: 20px;
      color: #555555;
      border-radius: 4px;
      vertical-align: middle;
      background-color: white;
      border: 1px solid #cccccc;
      box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
      transition: border linear 0.2s, box-shadow linear 0.2s;
    }
    input.search-query {
      height: 30px;
      width: 150px;
      margin-bottom: 0;
      border: 1px #cdcdcd solid;
      padding: 0 0 0 10px;
      border-radius: 3px;
      &:focus{
        border: 1px #00a2ca solid;
        background: #caf5ff;
      }
    }
  }
}
</style>
<template>
  <div class="page-title">
    <ul class="recommened-nav navigation clearfix">
      <router-link tag="li" to="/article" class="active"><a>文章</a></router-link>
      <router-link tag="li" to="/search" class=""><a>发现</a></router-link>
      <li class="search">
        <form class="search-form" target="_blank" action="#" accept-charset="UTF-8" method="get">
          <input name="utf8" type="hidden" value="✓">
          <input type="search" name="q" placeholder="搜索" class="input-medium search-query" onfocus="$(this).stop().animate({width: '300px'});" onblur="$(this).stop().animate({width:'150px'});">
          <span class="search_trigger" onclick="$('form.search-form').submit();"><i class="fa fa-search"></i></span>
        </form>
      </li>
    </ul>
  </div>
</template>