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
    max-width: 1000px;
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
    <sidebar class="left-aside"></sidebar>
    <div class="right-aside">
      <div class="list-container">
        <topnavbar></topnavbar>
        <router-view class="list-container-wrapper"></router-view>
        <hr />
        <siteFooter></siteFooter>
      </div>
    </div>
  </div>
</template>

<script>
import SideNavbar from './shared/SideNavbar.vue';
import TopNavbar from './shared/TopNavbar.vue';
import Footer from './shared/Footer.vue';

const home = {
  components: {
    'sidebar': SideNavbar,
    'topnavbar': TopNavbar,
    'siteFooter': Footer
  }
};

export default home;
</script>