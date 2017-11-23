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
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated=true
                    :per-page=5
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

        <add-user v-if="showAddUser"
                  :user_id="selectUser[0]"
                  @close="closePopUp()"></add-user>
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
                tableLoading: false,
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
                Api.getPost('v1', 'users', 'getUser')
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