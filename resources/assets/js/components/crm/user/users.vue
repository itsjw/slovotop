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
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="approveUser()">
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
                <th width="10%" class="left">
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
                <th width="15%" class="left">
                    <div class="ui-grid-block">

                        <search-pop
                            v-if="showSearchSurname"
                            position="left"
                            type="surname"
                            @submit="search"
                            @close="closePopUp()"></search-pop>


                        <i class="ui-icon ui-color col-orange hover ui-fnt size-3 ui-mr-1"
                           @click="showSearchSurname=true">search</i>
                        <i class="ui-icon ui-color col-red hover ui-fnt size-3 ui-mr-1"
                           v-show="queryParams[1]"
                           @click="search()">close</i>
                        <span>{{ trans('data.userSurname') }}</span>
                    </div>
                </th>
                <th width="15%" class="left">
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
                <th width="10%">{{ trans('data.userConfirm') }}</th>
                <th width="20%">{{ trans('data.userRole') }}</th>
                <th width="10%">{{ trans('data.created_at') }}</th>
                <th width="10%">{{ trans('data.updated_at') }}</th>
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
                        {{ item.role.name }}
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
                gql.getItem('v1', 'UserQuery', this.queryParams, 'user')
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
                    gql.setItem('v1', 'DeleteUserMutation', select)
                        .then(response => {
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
                    gql.setItem('v1', 'ApproveUserMutation', select)
                        .then(response => {
                            this.getUsers();
                        })
                }
            }
        }
    }
</script>