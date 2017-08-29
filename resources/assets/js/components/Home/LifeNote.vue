<style rel="stylesheet/scss" lang="scss">
.timeline{
  ul{
    padding-left: 3em;
  li{
    list-style: disc;
  }
  }
}
</style>

<template>
  <div class="list-container">
    <div class="timeline">
      <template v-for="(item,index) in articles">
        <h1 class="justcenter">{{ item.title }}</h1>
        <template v-if="item.link">原文: <a :href="item.link" target="_blank">{{ item.link }}</a></template>
        <div class="article" v-html="item.content"></div>
        <hr v-if="articles[index+1]" />
      </template>
    </div>
  </div>
</template>

<script>
import request, { createWebRequest } from '../../../common/network/request';
import hljs from '../../../common/libs/highlight.min';
export default  {
  data: ()=>({
    articles: []
  }),
  method: {},
  created(){
    request.get(createWebRequest('lifenote')).then(({ data = [] }) => {
      this.articles = data;
      setTimeout(()=>{
        hljs.configure({
          tabReplace: '    '
        });
        $('pre code').each(function(i, block) {
          hljs.highlightBlock(block);
        });
      }, 20);
    }).catch(({info='加载失败'}) => {
      window.alert(info);
    });
  }
};
</script>