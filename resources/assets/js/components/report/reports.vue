<template>
    <q-field
            count
            icon="account_box"
            helper="Some helper here"
            :label-width="3"
    >
        <q-chips-input float-label="Float Label" v-model="select" />
    </q-field>
</template>

<style scoped>

</style>

<script>
    export default {

        name: "reports",

        mounted() {
        },

        props: {},

        data() {
            return {
                select: ''
            }
        },

        methods: {
            // notice parameter "done" (Function)
            simulateProgress (event, done) {
                // simulate a delay, like in
                // waiting for an Ajax call
                setTimeout(() => {
                    // delay is over, now we call
                    // done() function to inform button
                    // it must go to its initial state
                    done()
                    // DON't forget to call done() otherwise
                    // the button will keep on being in
                    // "loading" state
                }, 3000)
            }
        }
    }
</script>