<style rel="stylesheet/scss" lang="scss">
  #main{
    display: flex;
    flex-direction: row;
    width:100%;
    margin-left: 75px;
    .left-aside{
      width: 30rem;
      height: 100%;
      position: fixed;
    }
    .right-aside{
      width: 100%;
      margin-left: 30em;
    }
    .list-container-wrapper{
      margin-top: 50px;
      padding: 13px 2em 0 20px;
    }
  }
</style>

<template>
  <div id="main" class="">
    <navbar class="left-aside"></navbar>
    <div class="right-aside">
      <topnavbar></topnavbar>
      <router-view class="list-container-wrapper"></router-view>
    </div>
  </div>
</template>

<script>
import SideNavbar from './SideNavbar.vue';
import TopNavbar from './TopNavbar.vue';

const home = {
  components: {
    'navbar': SideNavbar,
    'topnavbar': TopNavbar
  }
};

export default home;
</script>