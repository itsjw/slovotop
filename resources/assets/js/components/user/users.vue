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
                    :data="users"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated=true
                    :per-page=20
                    :checked-rows.sync="selectUser"
                    checkable>

                <template slot-scope="props">
                    <b-table-column field="name" :label="trans('data.userName')" sortable>
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column field="email" :label="trans('data.userEmail')" sortable>
                        {{ props.row.email }}
                    </b-table-column>

                    <b-table-column field="tasksCount" :label="trans('data.userTasks')" numeric sortable centered>
                        {{ props.row.tasksCount }}
                    </b-table-column>

                    <b-table-column field="lastLogin" :label="trans('data.userLastLogin')" sortable>
                        {{ props.row.lastLogin }}
                    </b-table-column>

                    <b-table-column field="confirm" :label="trans('data.userConfirm')" sortable centered>
                        {{ props.row.confirm }}
                    </b-table-column>

                    <b-table-column :label="trans('data.userRole')">
                        <span class="tag is-warning" v-for="(val,key) in props.row.roles">
                            {{ val.name }}
                        </span>
                    </b-table-column>

                    <b-table-column field="created_at" :label="trans('data.created_at')" sortable centered>
                        {{ props.row.created_at }}
                    </b-table-column>

                    <b-table-column field="id" label="ID" width="40" numeric sortable centered>
                        {{ props.row.id }}
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

    </div>
</template>
<script>
    import addUser from './addUser'

    export default {

        mounted() {
            this.getUsers();
        },

        props: [],

        data() {
            return {
                showAddUser: false,
                users: [],
                selectUser: [],
                order: 'asc',
                queryParams: ['orderID:"asc"'],
                showSearchName: false,
                showSearchSurname: false,
                showSearchEmail: false,
                // table
                tableLoading: false,
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
                this.tableLoading = true;
                this.selectUser = [];
                Api.getPost('v1', 'users', 'getUsers')
                    .then(response => {
                        this.users = response.data.data;
                        this.tableLoading = false;
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
                this.$modal.open({
                    parent: this,
                    component: addUser,
                    hasModalCard: true
                });
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