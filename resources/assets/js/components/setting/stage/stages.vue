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

                <a class="navbar-item" @click="deleteStage()">
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

    </div>
</template>
<script>
    import addStage from './addStage.vue';
    import accessTask from './accessTask.vue';

    export default {

        mounted() {
            this.getStages();
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
                Api.post('v1', 'getStages')
                    .then(response => {
                        this.stages = response.data.data;
                        this.selectStage = [];
                    })
            },

            /**
             * add stage
             */
            addStage() {
                this.selectStage = [];
                this.showAddStage = true;
            },

            /**
             * edit stage
             */
            editStage() {
                if (this.selectStage.length > 0) {
                    this.showAddStage = true;
                }
            },

            /**
             * delete stage
             */
            deleteStage() {
                if (this.selectStage.length > 0) {
                    if (confirm('Удалить')) {
                        let select = ['items:"' + this.selectStage + '"'];

                        gql.setItem('v2', 'DeleteTaskStageMutation', select)
                            .then(response => {
                                notify.make('success', response.data.data.DeleteTaskStageMutation.notify, 1);
                                this.getStages();
                            })
                    }
                }
            },

            /**
             * set access to field task
             */
            accessStage() {
                if (this.selectStage.length > 0) {
                    this.showAccessTask = true;
                }
            }
        }
    }
</script>