/**
 * Admin panel components
 */
Vue.component('adminSetting', require('./crm/setting/setting.vue'));
Vue.component('adminRoles', require('./crm/role/roles.vue'));
Vue.component('adminUsers', require('./crm/user/users.vue'));
Vue.component('adminProjects', require('./crm/project/projects.vue'));
Vue.component('adminDocs', require('./crm/doc/docs.vue'));

// search tip pop
Vue.component('searchPop', require('./searchPop.vue'));