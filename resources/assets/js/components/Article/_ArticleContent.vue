<style rel="stylesheet/scss" lang="scss">
.article{
  h1{
    font-size: 3em;
    margin: 0.67em 0;
  }
  h2{
    margin-bottom: 10.5px;
    margin-top: 21px;
  }
  a{
    color: #008E59;
    text-decoration: none;
    /*&:hover{*/
      /*color: #2E8E75;*/
    /*}*/
  }
  .justcenter{text-align: center;}
}
</style>

<template>
  <div class="article" v-html="article"></div>
</template>

<script>
import request, { createWebRequest } from '../../../common/network/request';
import hljs from '../../../common/libs/highlight.min';
import {ARTICLE_UPDATE} from "../../store/mutation_types";
export default {
  data: ()=>({
    article: null,
  }),
  created(){
    let article_id = this.$route.params.id;
    request.get(createWebRequest(`article/${article_id}`)).then(({ data = '文章不存在' }) => {
      this.article = data.content;
      this.$store.dispatch(ARTICLE_UPDATE, data).then(()=>{
        setTimeout(()=>{
          hljs.configure({
            tabReplace: '    '
          });
          $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
          });
        }, 20);
      });
    }).catch(({info='加载失败'}) => {

    });
  }
};
</script>