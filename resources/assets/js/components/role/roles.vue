<template>
    <div>

        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getRoles()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-reload" :class="tableLoading ? 'mdi-spin' : ''"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addRole()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-plus-circle"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editRole()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="editAccess()">
                     <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-human"></i>
                    </span>
                    <span>{{ trans('data.access') }}</span>
                </a>

                <a class="navbar-item" @click="confirmDeleteRole()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-delete"></i>
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

                    <b-table-column field="count" :label="trans('data.roleCount')" numeric sortable centered>
                        {{ props.row.count }}
                    </b-table-column>

                    <b-table-column field="created_at" :label="trans('data.created_at')" sortable centered>
                        {{ props.row.created_at }}
                    </b-table-column>

                    <b-table-column field="updated_at" :label="trans('data.updated_at')" sortable centered>
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
                                <b-icon icon="emoticon-sad" size="is-large">
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
    import addRole from './addRole.vue';
    import accessRole from './accessRole.vue';

    export default {

        mounted() {
            this.getRoles();

            this.$root.$on('getRoles', this.getRoles);
        },

        props: [],

        data() {
            return {
                roles: [],
                selectRole: [],
                // table
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
                this.$modal.open({
                    parent: this,
                    component: addRole,
                    hasModalCard: true,
                });
            },

            /**
             * edit role
             */
            editRole() {
                if (this.selectRole.length > 0) {
                    this.$modal.open({
                        parent: this,
                        component: addRole,
                        hasModalCard: true,
                        props: this.selectRole[0]
                    });
                    this.selectRole = [];
                }
            },

            /**
             * popup delete role
             */
            confirmDeleteRole() {
                if (this.selectRole.length > 0) {
                    this.$dialog.confirm({
                        cancelText: this.trans('data.no'),
                        confirmText: this.trans('data.yes'),
                        message: this.trans('data.deleteAsk'),
                        onConfirm: () => this.deleteRole()
                    });
                }
            },

            /**
             * delete role
             */
            deleteRole() {
                Api.post('v1', 'deleteRole', {items: this.selectRole})
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.getRoles();
                    })
            },

            /**
             * edit access role
             */
            editAccess() {
                if (this.selectRole.length > 0) {
                    this.$modal.open({
                        parent: this,
                        component: accessRole,
                        hasModalCard: true,
                        props: this.selectRole[0]
                    });
                    this.selectRole = [];
                }
            },
        }
    }
</script>