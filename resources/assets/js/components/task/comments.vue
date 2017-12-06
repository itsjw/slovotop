<template>
    <section>
        <div class="comment-wrap" id="comment-wrap">

            <div v-for="(val,key) in comments" :class="val.user.id == owner ? 'comment-left' : 'comment-right'">
                <p>
                    <strong>{{ val.user.name }}</strong>
                    <small>{{ val.body }}</small>
                </p>
            </div>

        </div>
        <br>
        <b-field :label="trans('data.commentsText')">
            <b-input type="textarea" minlength="2" maxlength="100"
                     v-model="comment.body"
                     :disabled="isRefresh"></b-input>
        </b-field>
        <button class="button is-info control" type="button"
                :disabled="isRefresh"
                @click="saveComment()">
            <b-icon
                    pack="fa"
                    :icon="isRefresh ? 'refresh' : 'check'"
                    :custom-class="isRefresh ? 'fa-spin' : ''">
            </b-icon>
            <span>{{ trans('data.commentsAdd') }}</span>
        </button>

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
                isRefresh: false,
                comments: [],
                comment: {}
            }
        },

        methods: {
            /**
             * get all comments
             */
            getComments() {
                this.comment.body = '';
                this.isRefresh = true;
                Api.post('v1', 'getTaskComments', {id: this.task})
                    .then(response => {
                        this.comments = response.data.data;
                        this.isRefresh = false;
                    })
            },

            /**
             * save comment
             */
            saveComment() {
                this.isRefresh = true;
                Api.post('v1', 'saveTaskComment', this.getDataComment(this.comment))
                    .then(response => {
                        this.getComments();
                        this.isRefresh = false;
                    })
                    .catch(error => {
                        this.$toast.open({
                            duration: 5000,
                            message: Api.errorSerializer(error.response.data.errors),
                            type: 'is-danger'
                        });
                        this.isRefresh = false;
                    });
            },

            /**
             * get data comment fo save
             * @param comment
             * @returns {{task: {default: number}|props.task|{default}|number, boby: *|string|ReadableStream|HTMLElement|Array|string, user: computed.userID}}
             */
            getDataComment(comment) {
                return {
                    task: this.task || 0,
                    comment: comment.body || '',
                    user: this.userID
                }
            }
        }
    }
</script>