<template>
    <div>

        <div class="ui-navbar ui-mb-5" v-if="accessMenu == 2">
            <ul>
                <li @click="addUser()">
                    <i class="ui-icon ui-mr-2">person_add</i>
                    <span>{{ trans('data.add') }}</span>
                </li>
                <li @click="editUser()">
                    <i class="ui-icon ui-mr-2">edit</i>
                    <span>{{ trans('data.edit') }}</span>
                </li>
                <li @click="approveUser()">
                    <i class="ui-icon ui-mr-2">touch_app</i>
                    <span>{{ trans('data.approve') }}</span>
                </li>
                <li @click="deleteUser()">
                    <i class="ui-icon ui-mr-2">delete</i>
                    <span>{{ trans('data.delete') }}</span>
                </li>
            </ul>
        </div>

        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="1%">
                    <i class="ui-icon size-3 ui-color col-green hover"
                       @click="getUsers()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="20%" class="left">
                    <div class="ui-grid-block">

                        <search-pop
                            v-if="showSearchName"
                            position="left"
                            type="name"
                            @submit="search"
                            @close="closePopUp()"></search-pop>

                        <i class="ui-icon ui-color col-orange hover ui-fnt size-3 ui-mr-1"
                           @click="showSearchName=true">search</i>
                        <i class="ui-icon ui-color col-red hover ui-fnt size-3 ui-mr-1"
                           v-show="queryParams[1]"
                           @click="search()">close</i>

                        <span>{{ trans('data.userName') }}</span>
                    </div>
                </th>
                <th width="20%" class="left">
                    <div class="ui-grid-block">

                        <search-pop
                            v-if="showSearchEmail"
                            position="left"
                            type="email"
                            @submit="search"
                            @close="closePopUp()"></search-pop>

                        <i class="ui-icon ui-color col-orange hover ui-fnt size-3 ui-mr-1"
                           @click="showSearchEmail=true">search</i>
                        <i class="ui-icon ui-color col-red hover ui-fnt size-3 ui-mr-1"
                           v-show="queryParams[1]"
                           @click="search()">close</i>

                        <span>{{ trans('data.userEmail') }}</span>
                    </div>
                </th>
                <th width="5%">{{ trans('data.userTasks') }}</th>
                <th width="10%">{{ trans('data.userLastLogin') }}</th>
                <th width="10%">{{ trans('data.userConfirm') }}</th>
                <th width="10%">{{ trans('data.userRole') }}</th>
                <th width="10%">{{ trans('data.created_at') }}</th>
                <th width="5%">
                    <div class="ui-grid-block center">
                        <i class="ui-icon ui-color col-orange hover ui-fnt size-1 ui-mr-1"
                           @click="orderByID()">sort</i>
                        <span>ID</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in users"
                @click="selectUsers(val.id)">
                <td>
                    <div v-if="isAdmin">
                        <input type="checkbox" :id="key" :value="val.id" v-model="selectUser"/>
                        <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                    </div>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td class="left">{{ val.email }}</td>
                <td>{{ val.tasksCount }}</td>
                <td>{{ val.lastLogin.updated_at }}</td>
                <td>{{ val.confirm == 1 ? trans('data.yes') : trans('data.no') }}</td>
                <td>
                    <span v-for="(item,k) in val.roles">
                        {{ item.role.name }}
                    </span>
                </td>
                <td>{{ val.created_at }}</td>
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
                selectUser: [],
                order: 'asc',
                queryParams: ['orderID:"asc"'],
                showSearchName: false,
                showSearchSurname: false,
                showSearchEmail: false,
            }
        },

        methods: {
            /**
             * close popup
             */
            closePopUp() {
                this.showAddUser = false;
                this.showSearchName = false;
                this.showSearchSurname = false;
                this.showSearchEmail = false;
                this.getUsers();
            },

            /**
             * order by ID
             */
            orderByID() {
                if (this.order === 'asc') {
                    this.queryParams.splice(0, 1, 'orderID:"desc"');
                    this.order = 'desc';
                } else {
                    this.queryParams.splice(0, 1, 'orderID:"asc"');
                    this.order = 'asc';
                }
                this.getUsers();
            },

            /**
             * search my type and value
             * @param value
             * @param type
             */
            search(value, type) {
                this.queryParams.splice(1, 1);

                if (value) {
                    this.queryParams.splice(1, 1, '' + type + ':"' + value + '"');
                }
                this.closePopUp();
            },

            /**
             * get all users
             */
            getUsers() {
                this.selectUser = [];
                gql.getItem('v2', 'UserQuery', this.queryParams, 'user')
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
                    gql.setItem('v2', 'DeleteUserMutation', select)
                        .then(response => {
                            notify.make('success', response.data.data.DeleteUserMutation.notify,1);
                            this.getUsers();
                        })
                }
            },

            /**
             * approve user
             */
            approveUser() {
                let select;
                if (this.selectUser.length > 0) {
                    select = ['items:"' + this.selectUser + '"'];
                    gql.setItem('v2', 'ApproveUserMutation', select)
                        .then(response => {
                            notify.make('success', response.data.data.ApproveUserMutation.notify,1);
                            this.getUsers();
                        })
                }
            }
        }
    }
</script>