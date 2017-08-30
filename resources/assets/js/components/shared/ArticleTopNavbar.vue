<style rel="stylesheet/scss" lang="scss">

</style>
<template>
  <div class="article-top-bar">
    <h4>
      <strong>Straysh的个人博客</strong> » <a href="http://www.straysh.com">首页</a> » <a :href="`/article?category=${category_id}`">{{ category }}</a>
    </h4>

    <form action="/search" class="header-search">
      <button type="submit" class="btn btn-link"><span class="sr-only hidden">搜索</span><span class="fa fa-search"></span></button>
      <input id="searchBox" name="q" type="text" placeholder="输入关键字搜索" class="form-control" value="" style="width: 180px;" onfocus="$(this).stop().animate({width: '300px'});" onblur="$(this).stop().animate({width:'180px'});">
    </form>
  </div>
</template>

<script>
export default {
  data: ()=>({
    category: 'Python',
    category_id: 1,
  })
};
</script>