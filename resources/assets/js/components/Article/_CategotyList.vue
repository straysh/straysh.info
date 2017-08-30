<style rel="stylesheet/scss" lang="scss">
.sort-nav{
  padding-left: 32px;
  li{
    float: left;
    margin: 10px 15px 5px 0;
    line-height: 20px;
    a{
      &:hover{
        background: #EEE;
      }
      color: #000;
      padding: 5px 10px;
      border: 1px solid #d9d9d9;
      border-radius: 14px;
      box-sizing: border-box;
      font-family: "lucida grande", "lucida sans unicode", lucida, helvetica, "Hiragino Sans GB", "Microsoft YaHei", "WenQuanYi Micro Hei", sans-serif;
      font-size: 12px;
      font-weight: normal;
      line-height: 1.5;
    }
  }
}
</style>

<template>
  <ul class="sort-nav clearfix">
    <li v-for="(item,index) in category" :class="item.id==category_id?'active':''">
      <a class="category" :href="`/article?category=${item.id}`">{{ item.name+'('+item.total+')' }}</a>
    </li>
  </ul>
</template>

<script>
import request, { createWebRequest } from '../../../common/network/request';
import UI from '../../../common/utils/UI';
export default {
  data: ()=>({
    category_id: null,
    category: []
  }),
  created(){
    this.category_id = UI.pageParams.category_id;
    request.get(createWebRequest('article/category')).then(({ data = [] }) => {
      this.category = data;
    }).catch(({info='加载失败'}) => {
      window.alert(info);
    });
  }
};
</script>