<template>
    <div>

        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getRoles()">
                    <span class="icon">
                        <i class="fa fa-refresh"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addRole()">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editRole()">
                    <span class="icon">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="editAccess()">
                    <span class="icon">
                        <i class="fa fa-thumbs-up"></i>
                    </span>
                    <span>{{ trans('data.access') }}</span>
                </a>

                <a class="navbar-item" @click="deleteRole()">
                    <span class="icon">
                        <i class="fa fa-trash"></i>
                    </span>
                    <span>{{ trans('data.delete') }}</span>
                </a>
            </div>
        </nav>

        <section class="ui-mt-2">
            <b-table
                    :data="roles"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated=true
                    :per-page=20
                    :checked-rows.sync="selectRole"
                    checkable>

                <template slot-scope="props">
                    <b-table-column field="name" :label="trans('data.roleName')" sortable>
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column field="email" :label="trans('data.roleCount')" numeric sortable centered>
                        {{ props.row.count }}
                    </b-table-column>

                    <b-table-column field="tasksCount" :label="trans('data.created_at')" sortable centered>
                        {{ props.row.created_at }}
                    </b-table-column>

                    <b-table-column field="lastLogin" :label="trans('data.updated_at')" sortable centered>
                        {{ props.row.updated_at }}
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
    Vue.component('addRole', require('./addRole.vue'));
    Vue.component('accessRole', require('./accessRole.vue'));

    export default {

        mounted() {
            this.getRoles();
        },

        props: [],

        data() {
            return {
                roles: [],
                selectRole: [],
                tableLoading: false
            }
        },

        methods: {

            /**
             * get all roles
             */
            getRoles() {
                this.tableLoading = true;
                Api.post('v1', 'getRoles')
                    .then(response => {
                        this.roles = response.data.data;
                        this.selectRole = [];
                        this.tableLoading = false;
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
                if (this.selectRole.length > 0) {
                    if (confirm('Удалить?')) {
                        let select = ['items:"' + this.selectRole + '"'];

                        gql.setItem('v2', 'DeleteRoleMutation', select)
                            .then(response => {
                                notify.make('success', response.data.data.DeleteRoleMutation.notify, 1);
                                this.getRoles();
                            })
                    }
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