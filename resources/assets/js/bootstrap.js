// Lodash
window._ = require('lodash');
//window.$ = window.jQuery = require('jquery');

// Axios
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

// Vue
window.Vue = require('vue');

// Buefy
import Buefy from 'buefy';
Vue.use(Buefy,{
    defaultIconPack: 'fa',
    defaultTimeFormatter: 'HH:mm',
    defaultTimeParser: 'HH:mm',
    defaultDayNames: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    defaultMonthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь',
        'Октябрь', 'Ноябрь', 'Декабрь']
});

// query builder
import Query from './query/query';
window.Api = new Query();

// lang from laravel trans
Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};