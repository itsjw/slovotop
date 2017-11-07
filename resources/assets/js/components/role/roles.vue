<template>
    <div>
        <div class="ui-grid-block ui-bg bg-blue ui-mb-3 ui-p-1">
            <div class="ui-grid-6 ui-grid-block">
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="addRole()">
                    <i class="ui-icon size-4">security</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.add') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="editRole()">
                    <i class="ui-icon size-4">edit</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.edit') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="editAccess()">
                    <i class="ui-icon size-4">fingerprint</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.access') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="deleteRole()">
                    <i class="ui-icon">delete</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.delete') }}</span>
                </div>
            </div>
            <div class="ui-grid-6"></div>
        </div>

        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="1%">
                    <i class="ui-icon size-3 ui-color col-green hover"
                       @click="getRoles()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="30%" class="left">{{ trans('data.roleName') }}</th>
                <th width="30%">{{ trans('data.roleCount') }}</th>
                <th width="15%">{{ trans('data.created_at') }}</th>
                <th width="15%">{{ trans('data.updated_at') }}</th>
                <th width="5%">ID</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in roles"
                @click="selectRoles(val.id)">
                <td>
                    <input type="checkbox" :id="key" :value="val.id" v-model="selectRole"/>
                    <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td>{{ val.count }}</td>
                <td>{{ val.created_at }}</td>
                <td>{{ val.updated_at }}</td>
                <td>{{ val.id }}</td>
            </tr>
            </tbody>
        </table>

        <add-role :role_id="selectRole[0]"
                  v-on:close="closePopUp()"
                  v-if="showAddRole"></add-role>

        <access-role :role_id="selectRole[0]"
                     v-on:close="closePopUp()"
                     v-if="showAccessRole"></access-role>

    </div>
</template>
<script>
    Vue.component('addRole', require('./addRole.vue'));
    Vue.component('accessRole', require('./accessRole.vue'));

    export default {

        mounted() {
            this.getRoles();
        },

        props: [],

        data() {
            return {
                showAddRole: false,
                showAccessRole: false,
                roles: {},
                selectRole: []
            }
        },

        methods: {
            /**
             * close popup
             */
            closePopUp() {
                this.showAccessRole = false;
                this.showAddRole = false;
                this.getRoles();
            },

            /**
             * select roles
             */
            selectRoles(id) {
                if (this.selectRole.indexOf(id) == -1) {
                    this.selectRole.push(id);
                } else {
                    this.selectRole.splice(this.selectRole.indexOf(id), 1);
                }
            },

            /**
             * get all roles
             */
            getRoles() {
                this.selectRole = [];
                gql.getItem('v1', 'RoleQuery', false, 'role')
                    .then(response => {
                        this.roles = response.data.data.RoleQuery;
                    })
            },

            /**
             * add role
             */
            addRole() {
                this.selectRole = [];
                this.showAddRole = true;
            },

            /**
             * edit role
             */
            editRole() {
                if (this.selectRole.length > 0) {
                    this.showAddRole = true;
                }
            },

            /**
             * delete role
             */
            deleteRole() {
                let select;
                if (this.selectRole.length > 0) {
                    if (confirm('Удалить?')) {
                        select = ['items:"' + this.selectRole + '"'];
                    }
                    gql.setItem('v1', 'DeleteRoleMutation', select)
                        .then(response => {
                            notify.make('success', response.data.data.DeleteRoleMutation.id,1);
                            this.getRoles();
                        })
                }
            },

            /**
             * edit access role
             */
            editAccess() {
                if (this.selectRole.length > 0) {
                    this.showAccessRole = true;
                }
            },
        }
    }
</script>