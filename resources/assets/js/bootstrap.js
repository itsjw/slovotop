window._ = require('lodash');
//window.$ = window.jQuery = require('jquery');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

window.Vue = require('vue');

import Query from './query/query';

window.gql = new Query();

// lang from laravel trans
Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};