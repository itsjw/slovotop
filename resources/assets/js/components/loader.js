/**
 * Admin panel components
 */
Vue.component('adminSetting', require('./setting/setting.vue'));
Vue.component('adminRoles', require('./role/roles.vue'));
Vue.component('adminUsers', require('./user/users.vue'));
Vue.component('adminProjects', require('./project/projects.vue'));
Vue.component('adminDocs', require('./doc/docs.vue'));

// search tip pop
Vue.component('searchPop', require('./searchPop.vue'));