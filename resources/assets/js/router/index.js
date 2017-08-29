/**
 * Created by straysh / <jobhancao@gmail.com> on 17-8-25.
 */

import Vue from 'vue';
import VueRouter from 'vue-router';

import ArticleList from './ArticleList';
import LifeNote from './LifeNote';
import Profile from './Profile';
import SiteInfo from './SiteInfo';

import Home from '../components/Home.vue';
import Article from '../components/Article.vue';

const childrenRoutes = [
  ArticleList,
  LifeNote,
  Profile,
  SiteInfo,
  {
    path: '',
    redirect: '/home'
  }
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
  {path: '/category', redirect: '/home'},
  {path: '/login', redirect: '/home'},
  {path: '', redirect: '/home'},
  {path: '*', redirect: '/home'},
];
Vue.use(VueRouter);
const router = new VueRouter({
  mode: 'hash',
  routes
});

export default router;