/**
 * Created by straysh / <jobhancao@gmail.com> on 17-9-1.
 */

import {ARTICLE_UPDATE} from "../mutation_types";

const state = {
  updated_at: '',
  created_at: '',
  content: ''
};

const mutations = {
  [ARTICLE_UPDATE] (state, article){
    state.updated_at = article.updated_at;
    state.created_at = article.created_at;
    state.content = article.content;
  }
};

const actions = {
  [ARTICLE_UPDATE] (context, article){
    return new Promise((resolve, reject)=>{
      context.commit(ARTICLE_UPDATE, article);
      resolve();
    });
  },
};

const getters = {
  article_updated_at (){
    return state.updated_at;
  },
  article_created_at (){
    return state.created_at;
  }
};

export default {
  state,
  mutations,
  getters,
  actions
};