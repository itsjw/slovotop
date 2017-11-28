/**
 * Admin panel components
 */
Vue.component('adminSetting', require('./setting/setting.vue'));
Vue.component('adminSubject', require('./subject/subjects.vue'));
Vue.component('adminRoles', require('./role/roles.vue'));
Vue.component('adminUsers', require('./user/users.vue'));
Vue.component('adminProjects', require('./project/projects.vue'));
Vue.component('adminTasks', require('./task/tasks.vue'));
Vue.component('adminTaskEdit', require('./task/taskEdit.vue'));
Vue.component('adminDocs', require('./doc/docs.vue'));
Vue.component('adminDocEdit', require('./doc/docEdit.vue'));

// Mixins
import Auth from '../mixin/Auth';

Vue.mixin(Auth);