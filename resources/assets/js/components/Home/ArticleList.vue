<style rel="stylesheet/scss" lang="scss">

</style>

<template>
  <div class="list-container">
    <categotyList></categotyList>
    <ul class="article-list thumbnails">
      <li v-for="(item,index) in articles" class="have-img">
        <a class="wrap-img" :href="`/article/${item['id']}`" v-if="item['thumbnail-image']">
          <img src="/images/article01.png" alt="300">
        </a>
        <div>
          <p class="list-top">
            <a class="author-name blue-link" :href="`/article?category=${item['category_id']}`">{{ item['category'] }}</a>
            <em>·</em>
            <span class="time" :ctime="item['created_at']">{{ item['created_at']|formatDate }}</span>
          </p>
          <h4 class="title"><a class="title-gray" :href="`/article/${item['id']}`">{{ item['title'] }}</a></h4>
          <div class="list-footer">
            <a target="_blank" href="javascript:void 0;">
              阅读 {{ item['hits'] }}
            </a>
            <a target="_blank" href="javascript:void 0;">
              · 评论 暂无评论
            </a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import request, { createWebRequest } from '../../../common/network/request';
import CategotyList from './_CategotyList.vue';
const articleList = {
  data: ()=>({
    articles: []
  }),
  components: {
    'categotyList': CategotyList
  },
  created(){
    request.get(createWebRequest('article')).then(({ data = [] }) => {
      this.articles = data;
    }).catch(({info='加载失败'}) => {
      window.alert(info);
    });
  }
};
export default articleList;
</script>