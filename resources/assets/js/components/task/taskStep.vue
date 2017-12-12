<template>
    <section>
        <div class="block">
            <b-tooltip :label="trans('data.reload')">
                <button class="button is-primary is-small">
                    <b-icon icon="reload"></b-icon>
                </button>
            </b-tooltip>
            <b-tooltip :label="trans('data.taskAddUser')">
                <button class="button is-success is-small" @click="addTaskStep">
                    <b-icon icon="plus-circle-outline"></b-icon>
                </button>
            </b-tooltip>
            <b-tooltip :label="trans('data.taskEditUser')">
                <button class="button is-link is-small">
                    <b-icon icon="pencil"></b-icon>
                </button>
            </b-tooltip>
            <b-tooltip :label="trans('data.taskDelUser')">
                <button class="button is-danger is-small">
                    <b-icon icon="delete"></b-icon>
                </button>
            </b-tooltip>
        </div>

        <b-table
                :data="taskSteps"
                :hoverable=true
                :narrowed=true
                :checked-rows.sync="testStepSelect"
                checkable>

            <template slot-scope="props">
                <b-table-column :label="trans('data.taskStage')">
                    {{ props.row.step }}
                </b-table-column>
                <b-table-column label="User">
                    {{ props.row.user }}
                </b-table-column>
                <b-table-column :label="trans('data.taskState')">
                    {{ props.row.user }}
                </b-table-column>
            </template>

            <template slot="empty">
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <b-icon icon="emoticon-sad" size="is-large">
                            </b-icon>
                        </p>
                        <p>{{ trans('data.searchNull') }}</p>
                    </div>
                </section>
            </template>
        </b-table>
    </section>
</template>

<script>
    import addTaskStep from './addTaskStep';

    export default {

        name: "task-steps",

        mounted() {
        },

        props: {},

        data() {
            return {
                taskSteps: [],
                testStepSelect: []
            }
        },

        methods: {
            /**
             * add/edit task step
             */
            addTaskStep() {
                this.$modal.open({
                    parent: this,
                    component: addTaskStep,
                    hasModalCard: true
                })
            }
        }
    }
</script>