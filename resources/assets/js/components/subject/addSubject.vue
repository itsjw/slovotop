<template>
    <form @submit.prevent="saveSubject()">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    {{ trans('data.subjectSubject') }}
                </p>
            </header>
            <section class="modal-card-body">
                <b-field :label="trans('data.subjectName')">
                    <b-input
                            type="text"
                            v-model="subject.name"
                            :placeholder="trans('data.subjectName')"
                            required>
                    </b-input>
                </b-field>

                <b-field :label="trans('data.subjectPrice')">
                    <b-input
                            type="number"
                            v-model="subject.price"
                            :placeholder="trans('data.subjectPrice')"
                            required>
                    </b-input>
                </b-field>
            </section>

            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">{{ trans('data.cancel') }}</button>
                <button class="button is-primary" type="submit">{{ trans('data.save') }}</button>
            </footer>
        </div>
    </form>

</template>
<script>
    export default {

        mounted() {
            if (this.subjectProp.id > 0) {
                this.subject = _.cloneDeep(this.subjectProp);
            }
        },

        props: {},

        data() {
            return {
                subjectProp: this.$parent.props || 0,
                subject: {}
            }
        },

        methods: {

            /**
             * save subject
             */
            saveSubject() {
                Api.post('v1', 'saveSubject', this.getSubjectData(this.subject))
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.$parent.close();
                        this.$root.$children[0].getSubjects();
                    })
                    .catch(error => {
                        this.$toast.open({
                            duration: 5000,
                            message: Api.errorSerializer(error.response.data.errors),
                            type: 'is-danger'
                        });
                    })
            },

            /**
             * get data for sent
             * @param subject
             */
            getSubjectData(subject) {
                return {
                    id: subject.id || 0,
                    name: subject.name || '',
                    price: subject.price || 0
                };
            }
        }
    }
</script>