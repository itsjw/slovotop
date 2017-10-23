<template>
    <div>
        <div class="ui-grid-block ui-bg bg-blue ui-mb-3 ui-p-1">
            <div class="ui-grid-6 ui-grid-block">
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="addUser()">
                    <i class="ui-icon size-4">person_add</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.add') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="editUser()">
                    <i class="ui-icon size-4">edit</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.edit') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover">
                    <i class="ui-icon size-4">touch_app</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.approve') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="deleteUser()">
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
                       @click="getUsers()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="10%" class="left">{{ trans('data.userName') }}</th>
                <th width="15%" class="left">{{ trans('data.userSurname') }}</th>
                <th width="15%" class="left">{{ trans('data.userEmail') }}</th>
                <th width="10%">{{ trans('data.userConfirm') }}</th>
                <th width="20%">{{ trans('data.userRole') }}</th>
                <th width="10%">{{ trans('data.userCreated_at') }}</th>
                <th width="10%">{{ trans('data.userUpdated_at') }}</th>
                <th width="5%">ID</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in users"
                @click="selectUsers(val.id)">
                <td>
                    <input type="checkbox" :id="key" :value="val.id" v-model="selectUser"/>
                    <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td class="left">{{ val.surname }}</td>
                <td class="left">{{ val.email }}</td>
                <td>{{ val.confirm == 1 ? trans('data.yes') : trans('data.no') }}</td>
                <td>
                    <span v-for="(item,k) in val.roles">
                        {{ item.role[0].name }}
                    </span>
                </td>
                <td>{{ val.created_at }}</td>
                <td>{{ val.updated_at }}</td>
                <td>{{ val.id }}</td>
            </tr>
            </tbody>
        </table>

        <add-user v-if="showAddUser"
                  :user_id="selectUser[0]"
                  v-on:close="closePopUp()"></add-user>
    </div>
</template>
<script>
    Vue.component('addUser', require('./addUser.vue'));

    export default {

        mounted() {
            this.getUsers();
        },

        props: [],

        data() {
            return {
                showAddUser: false,
                users: {},
                selectUser: []
            }
        },

        methods: {
            /**
             * close popup
             */
            closePopUp() {
                this.showAddUser = false;
                this.getUsers();
            },

            /**
             * get all users
             */
            getUsers() {
                this.selectUser = [];
                gql.getItem('v1', 'UserQuery', false, 'user')
                    .then(response => {
                        this.users = response.data.data.UserQuery;
                    })
            },

            /**
             * select users
             * @param id
             */
            selectUsers(id) {
                if (this.selectUser.indexOf(id) == -1) {
                    this.selectUser.push(id);
                } else {
                    this.selectUser.splice(this.selectUser.indexOf(id), 1);
                }
            },

            /**
             * add user
             */
            addUser() {
                this.selectUser = [];
                this.showAddUser = true;
            },

            /**
             * edit user
             */
            editUser() {
                if (this.selectUser.length > 0) {
                    this.showAddUser = true;
                }
            },

            /**
             * delete user
             */
            deleteUser() {
                let select;
                if (this.selectUser.length > 0) {
                    if (confirm('Удалить?')) {
                        select = ['items:"' + this.selectUser + '"'];
                    }
                    gql.setItem('v1', 'DeleteUser', select)
                        .then(response => {
                            this.getUsers();
                        })
                }
            }
        }
    }
</script>