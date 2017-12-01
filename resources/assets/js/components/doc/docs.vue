<template>
    <div>

        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getDocs()">
                    <span class="icon">
                        <i class="fa fa-refresh" :class="tableLoading ? 'fa-spin' : ''"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addDoc()">
                    <span class="icon">
                        <i class="fa fa-file-text"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editDoc()">
                    <span class="icon">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="confirmDeleteDoc()">
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
                    :data="docs"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated='tablePaginated'
                    :per-page=20
                    @click="view"
                    :checked-rows.sync="selectDoc"
                    :checkable="accessMenu == 2">

                <template slot-scope="props">
                    <b-table-column field="name" :label="trans('data.docsName')" sortable>
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column field="user.name" :label="trans('data.docsOwner')" sortable centered>
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
    export default {

        mounted() {
            this.getDocs();

            this.$root.$on('getDocs', this.getDocs);
        },

        props: {
            user_id: ''
        },

        data() {
            return {
                docs: [],
                selectDoc: [],
                // table
                tableLoading: false,
                tablePaginated: true,
                // search
                searchType: [
                    {name: this.trans('data.docsName'), type: 'name'},
                ],
                searchId: null,
                searchText: ''
            }
        },

        methods: {

            /**
             * only view doc
             */
            view(row) {
                if (this.accessMenu != 2) {
                    window.location = 'docs/doc/' + row.id;
                }
            },

            /**
             * search
             */
            search: _.debounce(function () {
                if (this.searchId != null) {
                    let params = {[this.searchType[this.searchId].type]: this.searchText};
                    this.getDocs(params);
                }
            }, 500),

            /**
             * get docs
             */
            getDocs(params = null) {
                this.tableLoading = true;
                Api.post('v1', 'getDocs', params)
                    .then(response => {
                        this.docs = response.data.data;
                        this.selectDoc = [];
                        this.tableLoading = false;
                    })
            },

            /**
             * add doc
             */
            addDoc() {
                window.location = 'docs/doc/';
            },

            /**
             * edit doc
             */
            editDoc() {
                if (this.selectDoc.length > 0) {
                    window.location = 'docs/doc/' + this.selectDoc[0].id;
                }
            },

            /**
             * popup delete doc
             */
            confirmDeleteDoc() {
                if (this.selectDoc.length > 0) {
                    this.$dialog.confirm({
                        cancelText: this.trans('data.no'),
                        confirmText: this.trans('data.yes'),
                        message: this.trans('data.deleteAsk'),
                        onConfirm: () => this.deleteDoc()
                    });
                }
            },

            /**
             * delete doc
             */
            deleteDoc() {
                Api.post('v1', 'deleteDoc', {items: this.selectDoc})
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.getDocs();
                    });
            }

        }
    }
</script>