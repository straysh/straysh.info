/**
 * Created by straysh / <jobhancao@gmail.com> on 17-8-25.
 */

import Vue from 'vue';
import VueRouter from 'vue-router';

import SiteInfo from './SiteInfo'
import LifeNote from './LifeNote'
import Aboutme from './Aboutme'

import Home from '../components/Home.vue';
import Article from '../components/Article.vue';

const childrenRoutes = [
  SiteInfo,
  LifeNote,
  Aboutme
];
const routes = [
  {
    path: '/',
    component: Home,
    children: [...childrenRoutes]
  },
  {
    path: '/article',
    component: Article
  },
  {path: '/category', redirect: '/'},
  {path: '/login', redirect: '/'},
  {path: '', redirect: '/'},
  {path: '*', redirect: '/'},
];
Vue.use(VueRouter);
const router = new VueRouter({
  mode: 'hash',
  routes
});

export default router;