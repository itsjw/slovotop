<template>
    <section>
        <q-toolbar color="primary" v-if="accessMenu == 2">
            <div>
                <q-btn flat @click="getSubjects()" no-caps>
                    <q-icon name="refresh" :class="tableLoading ? 'fa-spin' : ''"/>
                </q-btn>

                <q-btn flat @click="addSubject()" no-caps icon="add_circle_outline">
                    {{ trans('data.add') }}
                </q-btn>

                <q-btn flat @click="editSubject()" no-caps icon="mode_edit">
                    {{ trans('data.edit') }}
                </q-btn>

                <q-btn flat @click="confirmDeleteSubject()" no-caps icon="delete">
                    {{ trans('data.delete') }}
                </q-btn>
            </div>
        </q-toolbar>
        <q-toolbar color="green-1">
            <div class="row">

                <q-field icon="search">
                    <q-input v-model="searchText"
                             :float-label="trans('data.search')"
                             clearable
                             color="deep-purple"
                             @change="search"/>
                </q-field>
                <q-field icon="select_all" class="ui-ml-2">
                    <q-select
                            v-model="searchId"
                            :float-label="trans('data.searchParam')"
                            color="deep-purple"
                            radio
                            :options="searchType"
                    />
                </q-field>
                <q-field icon="done_all" class="ui-ml-2">
                    <q-toggle v-model="tablePaginated"
                              color="deep-purple"/>
                    <span class="text-deep-purple">{{ trans('data.showAll') }}</span>
                </q-field>

            </div>


        </q-toolbar>

        <section class="ui-mt-2">
            <b-table
                    :data="subjects"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated='tablePaginated'
                    :per-page=20
                    :checked-rows.sync="selectSubject"
                    :checkable="accessMenu == 2">

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
    import addSubject from './addSubject.vue';

    export default {

        mounted() {
            this.getSubjects();

            this.$root.$on('getSubjects', this.getSubjects);
        },

        props: {
            user_id: 0
        },

        data() {
            return {
                selectSubject: [],
                subjects: [],
                // table
                tableLoading: false,
                tablePaginated: true,
                // search
                searchType: [
                    {label: this.trans('data.subjectName'), type: 'name', value: 0},
                ],
                searchId: 0,
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
                    this.getSubjects(params);
                }
            }, 500),

            /**
             * get all subjects
             */
            getSubjects(params = null) {
                this.tableLoading = true;
                Api.post('v1', 'getSubjects', params)
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
             * popup delete subject
             */
            confirmDeleteSubject() {
                if (this.selectSubject.length > 0) {
                    this.$dialog.confirm({
                        cancelText: this.trans('data.no'),
                        confirmText: this.trans('data.yes'),
                        message: this.trans('data.deleteAsk'),
                        onConfirm: () => this.deleteSubject()
                    });
                }
            },

            /**
             * delete subject
             */
            deleteSubject() {
                Api.post('v1', 'deleteSubject', {items: this.selectSubject})
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.getSubjects();
                    })
            }
        }
    }
</script>