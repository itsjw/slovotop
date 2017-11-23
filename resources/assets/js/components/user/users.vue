<template>
    <div>

        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getUsers()">
                    <span class="icon">
                        <i class="fa fa-refresh"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addUser()">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editUser()">
                    <span class="icon">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="approveUser()">
                    <span class="icon">
                        <i class="fa fa-thumbs-up"></i>
                    </span>
                    <span>{{ trans('data.approve') }}</span>
                </a>

                <a class="navbar-item" @click="deleteUser()">
                    <span class="icon">
                        <i class="fa fa-trash"></i>
                    </span>
                    <span>{{ trans('data.delete') }}</span>
                </a>
            </div>
        </nav>

        <section class="ui-mt-2">
            <b-table
                    :data="isEmpty ? [] : tableDataSimple"
                    :hoverable="isHoverable"
                    :narrowed="isNarrowed"
                    :checked-rows.sync="selectUser"
                    checkable>

                <template slot-scope="props">
                    <b-table-column field="id" label="№" width="40" numeric sortable>
                        {{ props.row.id }}
                    </b-table-column>

                    <b-table-column field="first_name" :label="trans('data.userName')" width="20%" sortable>
                        {{ props.row.first_name }}
                    </b-table-column>

                    <b-table-column :label="trans('data.userEmail')" width="20%" sortable>
                        {{ props.row.last_name }}
                    </b-table-column>

                    <b-table-column :label="trans('data.userTasks')" width="5%" sortable>
                        {{ props.row.gender }}
                    </b-table-column>

                    <b-table-column :label="trans('data.userLastLogin')" width="10%" sortable>
                        {{ props.row.gender }}
                    </b-table-column>

                    <b-table-column :label="trans('data.userConfirm')" width="10%" sortable>
                        {{ props.row.gender }}
                    </b-table-column>

                    <b-table-column :label="trans('data.userRole')" width="10%" sortable>
                        {{ props.row.gender }}
                    </b-table-column>

                    <b-table-column :label="trans('data.created_at')" width="10%" sortable>
                        {{ props.row.gender }}
                    </b-table-column>

                    <b-table-column label="ID" width="40" numeric sortable>
                        {{ props.row.gender }}
                    </b-table-column>
                </template>

                <template slot="empty">
                    <section class="section">
                        <div class="content has-text-grey has-text-centered">
                            <p>
                                <b-icon
                                        icon="sentiment_very_dissatisfied"
                                        size="is-large">
                                </b-icon>
                            </p>
                            <p>Nothing here.</p>
                        </div>
                    </section>
                </template>
            </b-table>
        </section>

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
                    <div v-if="accessMenu == 2">
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
                // table
                isEmpty: false,
                isHoverable: true,
                isNarrowed: true,
                tableDataSimple: [
                    {
                        'id': 1,
                        'first_name': 'Jesse',
                        'last_name': 'Simmons',
                        'date': '2016-10-15 13:43:27',
                        'gender': 'Male'
                    },
                    {
                        'id': 2,
                        'first_name': 'John',
                        'last_name': 'Jacobs',
                        'date': '2016-12-15 06:00:53',
                        'gender': 'Male'
                    },
                    {
                        'id': 3,
                        'first_name': 'Tina',
                        'last_name': 'Gilbert',
                        'date': '2016-04-26 06:26:28',
                        'gender': 'Female'
                    },
                    {
                        'id': 4,
                        'first_name': 'Clarence',
                        'last_name': 'Flores',
                        'date': '2016-04-10 10:28:46',
                        'gender': 'Male'
                    },
                    {
                        'id': 5,
                        'first_name': 'Anne',
                        'last_name': 'Lee',
                        'date': '2016-12-06 14:38:38',
                        'gender': 'Female'
                    }
                ]
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
                            notify.make('success', response.data.data.DeleteUserMutation.notify, 1);
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
                            notify.make('success', response.data.data.ApproveUserMutation.notify, 1);
                            this.getUsers();
                        })
                }
            }
        }
    }
</script>