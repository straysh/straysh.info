
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

import UI from '../common/utils/UI';
import Vue from 'vue';
import { sync } from 'vuex-router-sync';
import App from './App.vue';
import store from './store';
import router from './router';

// sync the router with the vuex store.
// this registers `store.state.route`
sync(store, router);

// https://css-tricks.com/using-filters-vue-js/
Vue.filter('formatDate', function(value) {
  return UI.date.currentDate(value);
});
// create the app instance.
// here we inject the router and store to all child components,
// making them available everywhere as `this.$router` and `this.$store`.
const app = new Vue({
  router,
  store,
  el: '#app',
  render: h => h(App)
});

export { app, router, store };
