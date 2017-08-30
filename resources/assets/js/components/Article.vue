<style rel="stylesheet/scss" lang="scss">
#article-container{
  width:100%;
  margin-left: 75px;
  .list-container{
    margin-top: 0;
    padding: 13px 4em 0 4em;
  }
  .list-container-wrapper{
    padding: 13px 2em 0 20px;
  }
}
</style>

<template>
  <div id="article-container" class="">
    <div class="right-aside">
      <div class="list-container">
        <articleTopnavbar></articleTopnavbar>
        <router-view class="list-container-wrapper"></router-view>
        <hr />
        <siteFooter></siteFooter>
      </div>
    </div>
  </div>
</template>

<script>
  import ArticleTopNavbar from './shared/ArticleTopNavbar.vue';
  import Footer from './shared/Footer.vue';

  const home = {
    components: {
      'articleTopnavbar': ArticleTopNavbar,
      'siteFooter': Footer
    }
  };

  export default home;
</script>