import axios from 'axios';
import UI from '../utils/UI';

const {webHost, apiHost} = UI;

export const createWebRequest = uri => `${webHost}/${uri}`;
export const createApiRequest = uri => `${apiHost}/${uri}`;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.head.querySelector('meta[name="csrf-token"]');
if(token)
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
else
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');

//添加一个请求拦截器
axios.interceptors.request.use(function(config){
  //对返回的数据进行一些处理
  // Do something before request is sent
  let accessToken = window.localStorage.getItem('access_token') || null;
  if(accessToken) config.headers['Authorization'] = `Bearer ${accessToken}`;
  return config;
}, function (error) {
  // Do something with request error
  return Promise.reject(error);
});

//添加一个返回拦截器
axios.interceptors.response.use(function(response){
  //对返回的数据进行一些处理
  if(response.data && response.data.status && response.data.status<=10000)
    return response.data;
  else
    return Promise.reject(response.data);
},function(error){
  //对返回的错误进行一些处理
  return Promise.reject(error);
});

export default axios;