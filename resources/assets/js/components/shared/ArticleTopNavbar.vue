<style rel="stylesheet/scss" lang="scss">
.article-top-bar{
  font-size: 18px;
  margin-bottom: 10.5px;
  margin-top: 10.5px;
  h4{
    margin-bottom: 0.2em;
    strong{color: #556677;}
    a{
      color: #008E59;
      text-decoration: none;
    }
  }
  p{margin: 0 0 0.1em;}
  .header-search{
    line-height: 1.2;
    .form-submit{
      padding: 1px;
      font-size: inherit;
      line-height: inherit;
      border: 1px solid #bbbbbb;
    }
    .search-input{
      color: #555;
      padding: 1px 0 1px 0.5em;
      height: auto;
      font-size: inherit;
      line-height: inherit;
      &:focus{
        border: 1px #00a2ca solid;
        background: #caf5ff;
      }
    }
  }
}
</style>
<template>
  <div class="article-top-bar">
    <h4>
      <strong>Straysh的个人博客</strong> » <a :href="straysh">首页</a> » <router-link :to="`/article?category=${category.id}`">{{ category.name }}</router-link>
    </h4>

    <form action="/search" class="header-search form-inline">
      <button type="submit" class="form-submit btn" @click.stop.prevent=""><span class="sr-only hidden">搜索</span><span class="fa fa-search"></span></button>
      <div class="form-group">
        <input id="searchBox" class="search-input form-control" name="q" type="text" placeholder="输入关键字搜索" value="" style="width: 180px;" onfocus="$(this).stop().animate({width: '300px'});" onblur="$(this).stop().animate({width:'180px'});">
      </div>
    </form>
  </div>
</template>

<script>
import config from '../../config';

export default {
  computed: {
    category (){
      return this.$store.getters.article_category;
    }
  },
  data: ()=>({
    straysh: config.host,
  })
};
</script>