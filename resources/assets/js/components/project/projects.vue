<template>
    <div>

        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getProjects()">
                    <span class="icon">
                        <i class="fa fa-refresh"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addProject()">
                    <span class="icon">
                        <i class="fa fa-th-list"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editProject()">
                    <span class="icon">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="confirmDeleteProject()">
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
                    :data="projects"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated='tablePaginated'
                    :per-page=20
                    :checked-rows.sync="selectProject"
                    checkable>

                <template slot-scope="props">
                    <b-table-column field="name" :label="trans('data.projectName')" sortable>
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column field="site" :label="trans('data.projectSite')" numeric sortable centered>
                        {{ props.row.site }}
                    </b-table-column>

                    <b-table-column field="user.name" :label="trans('data.projectUser')" numeric sortable centered>
                        {{ props.row.user.name }}
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
    import addProject from './addProject.vue';

    export default {

        mounted() {
            this.getProjects()

            this.$root.$on('getProjects', this.getProjects);
        },

        props: {
            user_id: {
                default: 0
            }
        },

        data() {
            return {
                projects: [],
                selectProject: [],
                // table
                tableLoading: false,
                tablePaginated: true,
                // search
                searchType: [
                    {name: this.trans('data.projectName'), type: 'name'},
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
                    this.getProjects(params);
                }
            }, 500),

            /**
             * get all projects
             */
            getProjects(params = null) {
                this.tableLoading = true;
                Api.post('v1', 'getProjects', params)
                    .then(response => {
                        this.projects = response.data.data;
                        this.selectProject = [];
                        this.tableLoading = false;
                    })
            },

            /**
             * add project
             */
            addProject() {
                this.selectProject = [];
                this.$modal.open({
                    parent: this,
                    component: addProject,
                    hasModalCard: true,
                });
            },

            /**
             * edit project
             */
            editProject() {
                if (this.selectProject.length > 0) {
                    this.$modal.open({
                        parent: this,
                        component: addProject,
                        hasModalCard: true,
                        props: this.selectProject[0]
                    });
                    this.selectProject = [];
                }
            },

            /**
             * popup delete project
             */
            confirmDeleteProject() {
                if (this.selectProject.length > 0) {
                    this.$dialog.confirm({
                        cancelText: this.trans('data.no'),
                        confirmText: this.trans('data.yes'),
                        message: this.trans('data.deleteAsk'),
                        onConfirm: () => this.deleteProject()
                    });
                }
            },

            /**
             * delete project
             */
            deleteProject() {
                Api.post('v1', 'deleteProject', {items: this.selectProject})
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.getProjects();
                    });
            }
        }
    }
</script>