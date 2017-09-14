<style rel="stylesheet/scss" lang="scss">
#main{
  display: flex;
  flex-direction: row;
  width:100%;
  margin-left: 4.5rem;
  .left-aside{
    width: 30rem;
    height: 100%;
    position: fixed;
  }
  .right-aside{
    width: 100%;
    max-width: 1000px;
    margin-left: 30rem;
  }
  .list-container-wrapper{
    margin-top: 50px;
    padding: 13px 2em 0 20px;
  }
}

.thumbnails{
  padding-left: 36px;
  padding-right: 36px;
  margin: 35px 0 0;
}
.article-list{
  list-style: none;
  &>li {
    position: relative;
    width: 100%;
    padding-right: 2px;
    padding-bottom: 17px;
    margin: 0 0 17px;
    border-bottom: 1px dashed #d9d9d9;
    box-sizing: border-box;
    word-wrap: break-word;
  }
  .have-img {
    .wrap-img {
      float: right;
      width: 100px;
      height: 100px;
      img {
        max-width: 100%;
        vertical-align: middle;
        border-radius: 4px;
        border: 1px solid #eeeeee;
        box-sizing: border-box;
      }
    }
    &>div {
      padding-right: 110px;
    }
  }
  .list-top {
    margin: 8px 0;
    font-size: 12px;
  }
  .title {
    margin-top: 0;
    margin-bottom: 10px;
    margin-left: 0;
    display: inherit;
    font-size: 18px;
    font-weight: bold;
    line-height: 1.5;
  }
  .list-footer {
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
    a{color: gray;}
  }
}
.pagination {
  line-height: 23px;
  margin: 50px auto;
  a {
    font-size: 14px;
    background: #fff;
    border: 1px solid #e5e5e5;
    margin: 2px 6px 2px 0;
    padding: 2px 10px;
    text-decoration: none;
    &:hover{
      background: #EEE;
    }
  }
  .active {
    background: #CCC;
    border: 1px solid #8d8d8d;
    color: #393939;
    font-size: 14px;
    margin: 2px 6px 2px 0;
    padding: 2px 10px;
  }
}
</style>

<template>
  <div id="main" class="">
    <sidebar class="left-aside"></sidebar>
    <div class="right-aside">
      <div class="list-container">
        <topnavbar></topnavbar>
        <div class="list-container-wrapper">
          <categotyList></categotyList>
          <ul class="article-list thumbnails">
            <li v-for="(item,index) in articles" class="have-img">
              <router-link class="wrap-img" to="`/article/${item['id']}`" v-if="item['thumbnail-image']">
                <img src="/images/article01.png" alt="300">
              </router-link>
              <div>
                <p class="list-top">
                  <router-link :to="`/article?category=${item.category_id}`" class="author-name blue-link">{{ item.category }}</router-link>
                  <em>·</em>
                  <span class="time" :ctime="item['created_at']">{{ item['created_at']|formatDate }}</span>
                </p>
                <h4 class="title"><router-link class="title-gray" :to="`/article/${item['id']}`">{{ item['title'] }}</router-link></h4>
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
          <div class="pagination">
            <template v-for="page in maxPage">
              <span class="active" v-if="page === currentPage">{{ page }}</span>
              <a :href="`/article?page=${page}`" @click.stop.prevent="gotoPage(page)" v-else>{{ page }}</a>
            </template>
          </div>
        </div>
        </div>
    </div>
  </div>
</template>

<script>
import request, { createWebRequest } from '../../common/network/request';
import TopNavbar from './shared/TopNavbar.vue';
import SideNavbar from './shared/SideNavbar.vue';
import CategotyList from './Article/_CategotyList.vue';

const articleList = {
  data: ()=>({
    maxPage: 1,
    currentPage: 1,
    pagination: '',
    articles: []
  }),
  components: {
    'sidebar': SideNavbar,
    'topnavbar': TopNavbar,
    'categotyList': CategotyList
  },
  beforeRouteUpdate(to, from, next){
    this.currentPage = 1;
    this.category_id = to.query.category;
    this.loadPageData();
  },
//  watch: {
//    '$route'(to, from){
//      console.log('this', this);
//      console.log('to', to);
//      console.log('from', from);
////      this.currentPage = 1;
////      this.category_id = to.params.category;
////      this.loadPageData();
//      console.log('2 The current ID is ' + to.query.category);
//    },
//    '$route.query.category' () {
//      this.currentPage = 1;
//      this.category_id = this.$route.query.category;
//      this.loadPageData();
//      console.log('The current ID is ' + this.$route.query.category);
//    }
//  },
  methods: {
    gotoPage(page){
      this.currentPage = page;
      this.category_id = this.category_id || null;
      this.loadPageData();
    },
    loadPageData(){
      console.log('load category data');
      request.get(createWebRequest('article'), {params:{
        page: this.currentPage,
        category: this.category_id
      }}).then(({ data = [], maxPage=1}) => {
        this.articles = data;
        maxPage ? this.maxPage = maxPage : null;
      }).catch(({info='加载失败'}) => {
        window.alert(info);
      });
    }
  },
  created(){
    this.currentPage = 1;
    this.loadPageData();
  }
};
export default articleList;
</script>