<style rel="stylesheet/scss" lang="scss">
  html,body{
    width: 100%;
    margin: 0;
    padding: 0;
    font-size: 16px;
  }
  #app{
    display: flex;
    flex-direction: row;
    height: 100%;
    margin: 0;
    padding: 0;
  }
  .list-container{
    max-width: 1000px;
    margin-top: 50px;
    padding: 13px 2em 0 20px;
    font-size: 14px;
  }
  .site-footer, .profile, .timeline{
    p{margin: 0 0 10.5px;}
    a{
      color: #008E59;
      text-decoration: none;
      &:hover,&:focus{
        color: #004229;
        text-decoration: underline;
      }
    }
  }
  .timeline{
    h1{font-size: 2em;}
  }
  hr{
    margin:0.5em 0;
    border-style:inset;
  }
</style>

<template>
  <div id="app" class="">
    <sidebar></sidebar>
    <router-view></router-view>
  </div>
</template>

<script>
import SideBar from './components/shared/SideBar.vue';

const app = {
  components: {
    'sidebar': SideBar
  }
};

export default app;
</script>