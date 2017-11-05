// Lodash
window._ = require('lodash');
//window.$ = window.jQuery = require('jquery');

// Axios
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

// Vue
window.Vue = require('vue');

// notify
import Notify from './helpers/notify';
window.notify = new Notify();

// query builder for graphQL
import Query from './query/query';
window.gql = new Query();

// lang from laravel trans
Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};