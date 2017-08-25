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
</style>

<template>
  <div id="app" class="">
    <sidebar></sidebar>
    <router-view></router-view>
  </div>
</template>

<script>
import SideBar from './components/SideBar.vue';

const app = {
  components: {
    'sidebar': SideBar
  }
};

export default app;
</script>