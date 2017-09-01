/**
 * Created by straysh / <jobhancao@gmail.com> on 17-8-25.
 */

import Vue from 'vue';
import Vuex from 'vuex';

import article from './modules/article';

Vue.use(Vuex);

const modules = {
  article
};

const store = new Vuex.Store({
  modules
});

export default store;