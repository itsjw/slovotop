/**
 * Admin panel components
 */
Vue.component('adminSetting', require('./setting/setting.vue'));
Vue.component('adminRoles', require('./role/roles.vue'));
Vue.component('adminUsers', require('./user/users.vue'));
Vue.component('adminProjects', require('./project/projects.vue'));
Vue.component('adminDocs', require('./doc/docs.vue'));
Vue.component('adminDocEdit', require('./doc/docEdit.vue'));

// search tip pop
Vue.component('searchPop', require('./searchPop.vue'));

// Mixins
import Auth from '../mixin/Auth';

Vue.mixin(Auth);