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
                        <i class="fa fa-align-justify"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editSubject()">
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
                    :data="subjects"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated='tablePaginated'
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
                    {name: this.trans('data.subjectName'), type: 'name'},
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