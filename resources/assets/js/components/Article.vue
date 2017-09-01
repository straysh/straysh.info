<style rel="stylesheet/scss" lang="scss">
#article-container{
  width:100%;
  margin-left: 75px;
  .list-container{
    margin-top: 0;
    padding: 13px 4em 0 4em;
    .summary{
      border-top: 2px solid #DDDDDD;
      margin-bottom: 2em;
    }
  }
}
</style>

<template>
  <div id="article-container" class="">
    <div class="right-aside">
      <div class="list-container">
        <articleTopnavbar></articleTopnavbar>
        <div class="summary">
          <a href="/">分类</a>: {{ category.name }} ( 共{{ category.article_amount }}篇文章 )
          <p>Created At: {{ article_created_at }} | Last Updated At: {{ article_updated_at }}</p>
        </div>
        <articleContent></articleContent>
        <hr />
        <siteFooter></siteFooter>
      </div>
    </div>
  </div>
</template>

<script>
import ArticleTopNavbar from './shared/ArticleTopNavbar.vue';
import ArticleContent from './Article/_ArticleContent.vue';
import Footer from './shared/Footer.vue';

export default {
  data: ()=>({
    category: {
      'name': 'Python',
      'article_amount': 30
    },
  }),
  computed: {
    article_updated_at (){
      return this.$store.getters.article_updated_at;
    },
    article_created_at (){
      return this.$store.getters.article_created_at;
    }
  },
  components: {
    'articleTopnavbar': ArticleTopNavbar,
    'articleContent': ArticleContent,
    'siteFooter': Footer
  }
};
</script>