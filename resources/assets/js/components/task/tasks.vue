<template>
    <section>
        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getTasks()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-reload" :class="tableLoading ? 'mdi-spin' : ''"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addTask()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-plus-circle"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editTask()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="confirmDeleteTask()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-delete"></i>
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
                    checkable
                    detailed
                    detail-key="id"
                    @details-open="(row, index)">

                <template slot-scope="props">
                    <b-table-column field="name" :label="trans('data.taskName')" sortable>
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column field="project.name" :label="trans('data.projectName')" sortable>
                        {{ props.row.project.name }}
                    </b-table-column>

                    <b-table-column field="author.name" :label="trans('data.taskUser')" sortable centered>
                        {{ props.row.author ? props.row.author.name : '' }}
                    </b-table-column>

                    <b-table-column field="owner.name" :label="trans('data.taskOwner')" sortable centered>
                        {{ props.row.owner.name }}
                    </b-table-column>

                    <b-table-column field="created_at" :label="trans('data.created_at')" sortable centered>
                        {{ props.row.created_at }}
                    </b-table-column>

                    <b-table-column field="dateEnd" :label="trans('data.taskDateEnd')" sortable centered>
                        {{ props.row.dateEnd }}
                    </b-table-column>

                    <b-table-column field="id" label="ID" width="40" numeric sortable centered>
                        {{ props.row.id }}
                    </b-table-column>
                </template>

                <template slot="detail" slot-scope="props">
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{ trans('data.taskName') }} :</strong>
                                <small>{{ props.row.name }}</small>
                            </p>
                            <p>
                                <strong>{{ trans('data.taskStage') }} :</strong>
                                <small>{{ props.row.stage.name }}</small>
                            </p>
                            <p>
                                <strong>{{ trans('data.taskEditor') }} :</strong>
                                <small>{{ props.row.editor ? props.row.editor.name : ''}}</small>
                            </p>
                            <p>
                                <strong>{{ trans('data.taskSubject') }} :</strong>
                                <small>{{ props.row.subject.name }}</small>
                            </p>
                            <p>
                                <strong>{{ trans('data.taskPrice') }} :</strong>
                                <small>{{ props.row.price }}</small>
                            </p>
                            <p>
                                <strong>{{ trans('data.taskTask') }} :</strong>
                                <small>{{ props.row.task }}</small>
                            </p>
                        </div>
                    </div>
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
                row: '',
                index: '',
                // search
                searchType: [
                    {name: this.trans('data.taskName'), type: 'name'},
                    {name: this.trans('data.projectName'), type: 'project'},
                    {name: this.trans('data.taskUser'), type: 'author'},
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
                this.tableLoading = true;
                Api.post('v1', 'getTasks', params)
                    .then(response => {
                        this.tasks = response.data.data;
                        this.selectTask = [];
                        this.tableLoading = false;
                    })
            },

            /**
             * add task
             */
            addTask() {
                window.location = '/crm/tasks/task/';
            },

            /**
             * edit task
             */
            editTask() {
                if (this.selectTask.length > 0) {
                    window.location = '/crm/tasks/task/' + this.selectTask[0].id;
                }
            },

            /**
             * popup delete task
             */
            confirmDeleteTask() {
                if (this.selectTask.length > 0) {
                    this.$dialog.confirm({
                        cancelText: this.trans('data.no'),
                        confirmText: this.trans('data.yes'),
                        message: this.trans('data.deleteAsk'),
                        onConfirm: () => this.deleteTask()
                    });
                }
            },

            /**
             * delete task
             */
            deleteTask() {
                Api.post('v1', 'deleteTask', {items: this.selectTask})
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.getTasks();
                    })
            }
        }
    }
</script>