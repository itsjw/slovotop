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

                <a class="navbar-item" @click="confirmDeleteSubject()">
                    <span class="icon">
                        <i class="fa fa-trash"></i>
                    </span>
                    <span>{{ trans('data.delete') }}</span>
                </a>
            </div>
        </nav>

        <section class="ui-mt-2">
            <b-table
                    :data="projects"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated=true
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
    import addProject from './addProject.vue';

    export default {

        mounted() {
            this.getProjects()
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
                tableLoading: false
            }
        },

        methods: {

            /**
             * get all projects
             */
            getProjects() {
                this.tableLoading = true;
                Api.post('v1', 'getProjects')
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
                this.showAddProject = true;
            },

            /**
             * edit project
             */
            editProject() {
                if (this.selectProject.length > 0) {
                    this.showAddProject = true;
                }
            },

            /**
             * popup delete project
             */
            confirmDeleteSubject() {
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