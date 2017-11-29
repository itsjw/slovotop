<template>
    <div class="ui-pt-2 bg bg-wite">

        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item" @click="getStages()">
                    <span class="icon">
                        <i class="fa fa-refresh"></i>
                    </span>
                </a>

                <a class="navbar-item" @click="addStage()">
                    <span class="icon">
                        <i class="fa fa-tasks"></i>
                    </span>
                    <span>{{ trans('data.add') }}</span>
                </a>

                <a class="navbar-item" @click="editStage()">
                    <span class="icon">
                        <i class="fa fa-pencil"></i>
                    </span>
                    <span>{{ trans('data.edit') }}</span>
                </a>

                <a class="navbar-item" @click="confirmDeleteStage()">
                    <span class="icon">
                        <i class="fa fa-trash"></i>
                    </span>
                    <span>{{ trans('data.delete') }}</span>
                </a>

                <a class="navbar-item" @click="accessStage()">
                    <span class="icon">
                        <i class="fa fa-shield"></i>
                    </span>
                    <span>{{ trans('data.stageAccessTask') }}</span>
                </a>
            </div>
        </nav>

        <section class="ui-mt-2">
            <b-table
                    :data="stages"
                    :hoverable=true
                    :loading='tableLoading'
                    :narrowed=true
                    :paginated=true
                    :per-page=20
                    :checked-rows.sync="selectStage"
                    checkable>

                <template slot-scope="props">
                    <b-table-column field="name" :label="trans('data.stageName')" sortable>
                        {{ props.row.name }}
                    </b-table-column>

                    <b-table-column field="count" :label="trans('data.stagePriority')" numeric sortable centered>
                        {{ props.row.priority }}
                    </b-table-column>

                    <b-table-column field="created_at" :label="trans('data.stagePrice')" numeric sortable centered>
                        {{ props.row.price }}
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
    import addStage from './addStage.vue';
    import accessTask from './accessTask.vue';

    export default {

        mounted() {
            this.getStages();

            this.$root.$on('getStages', this.getStages);
        },

        props: {},

        data() {
            return {
                selectStage: [],
                stages: [],
                // table
                tableLoading: false
            }
        },

        methods: {

            /**
             * get all stages
             */
            getStages() {
                this.tableLoading = true;
                Api.post('v1', 'getStages')
                    .then(response => {
                        this.stages = response.data.data;
                        this.tableLoading = false;
                        this.selectStage = [];
                    });
            },

            /**
             * add stage
             */
            addStage() {
                this.selectStage = [];
                this.$modal.open({
                    parent: this,
                    component: addStage,
                    hasModalCard: true,
                });
            },

            /**
             * edit stage
             */
            editStage() {
                if (this.selectStage.length > 0) {
                    this.$modal.open({
                        parent: this,
                        component: addStage,
                        hasModalCard: true,
                        props: this.selectStage[0]
                    });
                    this.selectStage = [];
                }
            },

            /**
             * popup delete role
             */
            confirmDeleteStage() {
                if (this.selectStage.length > 0) {
                    this.$dialog.confirm({
                        cancelText: this.trans('data.no'),
                        confirmText: this.trans('data.yes'),
                        message: this.trans('data.deleteAsk'),
                        onConfirm: () => this.deleteStage()
                    });
                }
            },

            /**
             * delete stage
             */
            deleteStage() {
                Api.post('v1', 'deleteStage', {items: this.selectStage})
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.getStages();
                    })
            },

            /**
             * set access to field task
             */
            accessStage() {
                if (this.selectStage.length > 0) {
                    this.$modal.open({
                        parent: this,
                        component: accessTask,
                        hasModalCard: true,
                        props: this.selectStage[0]
                    });
                    this.selectStage = [];
                }
            }
        }
    }
</script>