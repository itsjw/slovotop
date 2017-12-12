<template>
    <section>
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