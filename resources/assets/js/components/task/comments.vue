<template>
    <section>
        <div class="comment-wrap">

            <div v-for="(val,key) in comments" :class="val.user.id == owner ? 'comment-left' : 'comment-right'">
                <p>
                    <strong>{{ val.user.name }}</strong>
                    <small>{{ val.body }}</small>
                </p>
            </div>

        </div>



    </section>
</template>

<style scoped>

</style>

<script>
    export default {

        name: "comments",

        mounted() {
            if (this.task > 0) {
                this.getComments();
            }
        },

        props: {
            task: {
                default: 0
            },
            owner: {}
        },

        data() {
            return {
                comments: []
            }
        },

        methods: {
            getComments() {
                Api.post('v1', 'getTaskComments', {id: this.task})
                    .then(response => {
                        this.comments = response.data.data;
                    })
            }
        }
    }
</script>