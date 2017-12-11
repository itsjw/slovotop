<template>
    <div>

        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getUsers()">
                    <span class="icon">
                        <i class="fa fa-refresh" :class="tableLoading ? 'fa-spin' : ''"></i>
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

                <a class="navbar-item" @click="confirmDeleteUser()">
                    <span class="icon">
                        <i class="fa fa-trash"></i>
                    </span>
                    <span>{{ trans('data.delete') }}</span>
                </a>
            </div>
        </nav>

        <section class="ui-mt-2">
            <b-field grouped group-multiline>
                <b-input :placeholder="trans('data.search')"
                         type="search"
                         icon-pack="fa"
                         icon="search"
                         v-model="searchText"
                         @input="search">
                </b-input>
                <b-select :placeholder="trans('data.searchParam')" v-model="searchId">
                    <option
                            v-for="(val,key) in searchType"
                            :value="key"
                            :key="key">
                        {{ val.name }}
                    </option>
                </b-select>
                <div class="control is-flex">
                    <b-switch :true-value="false" :false-value="true"
                              type="is-info"
                              v-model="tablePaginated">
                        {{ trans('data.showAll') }}
                    </b-switch>
                </div>
            </b-field>

            <b-table
                    :data="users"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated=tablePaginated
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

                    <b-table-column field="lastLogin" :label="trans('data.userLastLogin')" sortable centered>
                        {{ props.row.lastLogin }}
                    </b-table-column>

                    <b-table-column field="confirm" :label="trans('data.userConfirm')" sortable centered>
                        {{ props.row.confirm == 1 ? trans('data.yes') : trans('data.no') }}
                    </b-table-column>

                    <b-table-column :label="trans('data.userRole')">
                        <div class="tags">
                            <span class="tag is-warning" v-for="(val,key) in props.row.roles">
                                {{ val.name }}
                            </span>
                        </div>
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
                                        icon="ban"
                                        icon-pack="fa"
                                        size="is-large">
                                </b-icon>
                            </p>
                            <p>{{ trans('data.searchNull') }}</p>
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

            this.$root.$on('getUsers', this.getUsers);
        },

        props: [],

        data() {
            return {
                users: [],
                selectUser: [],
                // table
                tableLoading: false,
                tablePaginated: true,
                // search
                searchType: [
                    {name: this.trans('data.userName'), type: 'name'},
                    {name: this.trans('data.userEmail'), type: 'email'},
                ],
                searchId: null,
                searchText: ''
            }
        },

        methods: {

            /**
             * search
             */
            search: _.debounce(function () {
                if (this.searchId != null) {
                    let params = {[this.searchType[this.searchId].type]: this.searchText};
                    this.getUsers(params);
                }
            }, 500),

            /**
             * get all users
             */
            getUsers(params = null) {
                this.tableLoading = true;
                Api.post('v1', 'getUsers', params)
                    .then(response => {
                        this.users = response.data.data;
                        this.tableLoading = false;
                        this.selectUser = [];
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
                    hasModalCard: true,
                });
            },

            /**
             * edit user
             */
            editUser() {
                if (this.selectUser.length > 0) {
                    this.$modal.open({
                        parent: this,
                        component: addUser,
                        props: this.selectUser[0],
                        hasModalCard: true,
                    });
                    this.selectUser = [];
                }
            },

            /**
             * popup delete user
             */
            confirmDeleteUser() {
                if (this.selectUser.length > 0) {
                    this.$dialog.confirm({
                        cancelText: this.trans('data.no'),
                        confirmText: this.trans('data.yes'),
                        message: this.trans('data.deleteAsk'),
                        onConfirm: () => this.deleteUser()
                    });
                }
            },

            /**
             * delete user
             */
            deleteUser() {
                Api.post('v1', 'deleteUser', {items: this.selectUser})
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.getUsers();
                    })
            },

            /**
             * approve user
             */
            approveUser() {
                if (this.selectUser.length > 0) {
                    Api.post('v1', 'approveUser', {items: this.selectUser})
                        .then(response => {
                            this.$toast.open({
                                message: response.data.success,
                                type: 'is-success'
                            });
                            this.getUsers();
                        })
                }
            }
        }
    }
</script>