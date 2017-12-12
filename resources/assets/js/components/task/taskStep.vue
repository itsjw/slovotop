<template>
    <section>
        <div class="block">
            <b-tooltip label="Tooltip top">
                <button class="button is-primary is-small">
                    <b-icon icon="reload"></b-icon>
                </button>
            </b-tooltip>
            <b-tooltip label="Tooltip top">
                <button class="button is-success is-small">
                    <b-icon icon="plus-circle-outline"></b-icon>
                </button>
            </b-tooltip>
            <b-tooltip label="Tooltip top">
                <button class="button is-link is-small">
                    <b-icon icon="pencil"></b-icon>
                </button>
            </b-tooltip>
            <b-tooltip label="Tooltip top">
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
                <b-table-column label="Step">
                    {{ props.row.step }}
                </b-table-column>
                <b-table-column label="User">
                    {{ props.row.user }}
                </b-table-column>
            </template>
        </b-table>
    </section>
</template>

<style scoped>

</style>

<script>
    export default {

        name: "task-steps",

        mounted() {
        },

        props: {},

        data() {
            return {
                taskSteps: [{step: 'hello', user: 'Test'}],
                testStepSelect: []
            }
        },

        methods: {}
    }
</script>