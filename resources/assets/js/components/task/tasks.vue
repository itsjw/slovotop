<template>
    <section>
        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getTasks()">
                    <span class="icon">
                        <i class="fa fa-refresh"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addTask()">
                    <span class="icon">
                        <i class="fa fa-tasks"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editTask()">
                    <span class="icon">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="deleteTask()">
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
                    :data="tasks"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated='tablePaginated'
                    :per-page=20
                    :checked-rows.sync="selectTask"
                    checkable>

                <template slot-scope="props">
                    <b-table-column field="name" :label="trans('data.taskName')" sortable>
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column field="project" :label="trans('data.projectName')" sortable>
                        {{ props.row.project }}
                    </b-table-column>

                    <b-table-column field="state" :label="trans('data.taskState')" sortable centered>
                        {{ props.row.state }}
                    </b-table-column>

                    <b-table-column field="user" :label="trans('data.taskUser')" sortable centered>
                        {{ props.row.user }}
                    </b-table-column>

                    <b-table-column field="owner" :label="trans('data.taskOwner')" sortable centered>
                        {{ props.row.owner }}
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
    </section>
</template>
<script>
    export default {

        mounted() {
            this.getTasks();
        },

        props: {
            user_id: {}
        },

        data() {
            return {
                selectTask: [],
                tasks: [],
                // tables
                tableLoading: false,
                tablePaginated: true,
                // search
                searchType: [
                    {name: this.trans('data.taskName'), type: 'name'},
                    {name: this.trans('data.projectName'), type: 'project'},
                    {name: this.trans('data.taskUser'), type: 'user'},
                    {name: this.trans('data.taskOwner'), type: 'owner'},
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
                    this.getTasks(params);
                }
            }, 500),

            /**
             * gel all tasks
             */
            getTasks(params = null) {
            },

            /**
             * add task
             */
            addTask() {
                window.location = '/crm/tasks/task/';
            },

            editTask() {
            },
            deleteTask() {
            }
        }
    }
</script>