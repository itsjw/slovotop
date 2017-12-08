<template>
    <section>
        <q-toolbar color="primary" v-if="accessMenu == 2">
            <div>
                <q-btn flat @click="getSubjects()" no-caps>
                    <q-icon name="refresh"/>
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
            </div>
        </q-toolbar>

        <q-data-table
                :data="subjects"
                :config="config"
                :columns="columns"
                @selection="select"
                @refresh="getSubjects()">

        </q-data-table>

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
                config: {
                    rowHeight: '30px',
                    responsive: true,
                    pagination: {
                        rowsPerPage: 15,
                        options: [30, 50, 100]
                    },
                    selection: 'multiple',
                    messages: {
                        noData: '<i class="icon">warning</i>' + this.trans('data.searchNull'),
                    },
                    labels: {
                        columns: 'Coluuuuumns',
                        allCols: 'Eeeeeeeeevery Cols',
                        rows: 'Rooows',
                        selected: {
                            singular: 'item selected.',
                            plural: 'items selected.'
                        },
                        clear: 'clear',
                        search: 'Search',
                        all: 'All'
                    }
                },
                columns: [
                    {
                        label: this.trans('data.subjectName'),
                        field: 'name',
                        sort: true,
                        type: 'string',
                    },
                    {
                        label: this.trans('data.subjectPrice'),
                        field: 'price',
                        sort: true,
                        type: 'number'
                    },
                    {
                        label: this.trans('data.created_at'),
                        field: 'created_at',
                        sort: true,
                        type: 'date'
                    },
                    {
                        label: this.trans('data.updated_at'),
                        field: 'updated_at',
                        sort: true,
                        type: 'date'
                    }
                ],
                // search
                searchType: [
                    {label: this.trans('data.subjectName'), type: 'name', value: 0},
                ],
                searchId: 0,
                searchText: ''
            }
        },

        methods: {

            select(select, data) {
                console.log(data);
            },

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
                Api.post('v1', 'getSubjects', params)
                    .then(response => {
                        this.subjects = response.data.data;
                        this.selectSubject = [];
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