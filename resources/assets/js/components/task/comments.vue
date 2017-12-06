<template>
    <section>
        Hello
    </section>
</template>

<style scoped>

</style>

<script>
    export default {

        name: "comments",

        mounted() {
        },

        props: {
            comments: {}
        },

        data() {
            return {
                comment: [
                    {id:1,body:'Test Comm',User: {name: 'Vaso'}}
                ]
            }
        },

        methods: {}
    }
</script>