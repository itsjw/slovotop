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
            if (this.subject_id > 0) {
                this.getSubject(this.subject_id);
            }
        },

        props: {
            subject_id: {
                default: 0
            }
        },

        data() {
            return {
                subject: {}
            }
        },

        methods: {

            /**
             * save subject
             */
            saveSubject() {
                gql.setItem('v2', 'AddTaskSubjectMutation', this.getSubjectData(this.subject))
                    .then(response => {
                        if (response.data.errors) {
                            notify.make('alert', response.data.errors[0].validation);
                        } else {
                            notify.make('success', response.data.data.AddTaskSubjectMutation.notify, 2);
                            this.$emit('close');
                        }
                    });
            },

            /**
             * get data for sent
             * @param subject
             */
            getSubjectData(subject) {
                return {
                    id: this.subject_id == 0 ? this.subject_id : subject.id,
                    name: subject.name || '',
                    price: subject.price || 0
                };
            }
        }
    }
</script>