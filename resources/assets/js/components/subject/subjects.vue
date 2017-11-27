<template>
    <div>

        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getSubjects()">
                    <span class="icon">
                        <i class="fa fa-refresh"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addSubject()">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editSubject()">
                    <span class="icon">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="deleteSubject()">
                    <span class="icon">
                        <i class="fa fa-trash"></i>
                    </span>
                    <span>{{ trans('data.delete') }}</span>
                </a>
            </div>
        </nav>

        <section class="ui-mt-2">
            <b-table
                    :data="subjects"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated=true
                    :per-page=20
                    :checked-rows.sync="selectSubject"
                    checkable>

                <template slot-scope="props">
                    <b-table-column field="name" :label="trans('data.subjectName')" sortable>
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column field="price" :label="trans('data.subjectPrice')" numeric sortable centered>
                        {{ props.row.price }}
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
    import addSubject from './addSubject.vue';

    export default {

        mounted() {
            this.getSubjects();
        },

        props: {
            user_id: 0
        },

        data() {
            return {
                selectSubject: [],
                subjects: [],
                tableLoading: false
            }
        },

        methods: {

            /**
             * get all subjects
             */
            getSubjects() {
                this.tableLoading = true;
                Api.post('v1', 'getSubjects')
                    .then(response => {
                        this.subjects = response.data.data;
                        this.selectSubject = [];
                        this.tableLoading = false;
                    })
            },

            /**
             * add subject
             */
            addSubject() {
                this.selectSubject = [];
                this.$modal.open({
                    parent: this,
                    component: addSubject,
                    hasModalCard: true,
                });
            },

            /**
             * edit subject
             */
            editSubject() {
                if (this.selectSubject.length > 0) {
                    this.$modal.open({
                        parent: this,
                        component: addSubject,
                        hasModalCard: true,
                        props: this.selectSubject[0]
                    });
                    this.selectSubject = [];
                }
            },

            /**
             * delete subject
             */
            deleteSubject() {
                if (this.selectSubject.length > 0) {
                    if (confirm('Удалить?')) {
                        let select = ['items:"' + this.selectSubject + '"'];

                        gql.setItem('v2', 'DeleteTaskSubjectMutation', select)
                            .then(response => {
                                notify.make('success', response.data.data.DeleteTaskSubjectMutation.notify, 1);
                                this.getSubjects();
                            })
                    }
                }
            }
        }
    }
</script>