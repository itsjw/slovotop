<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w25 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.subjectName') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="text"
                           v-model="subject.name">
                </div>
                <div class="ui-mb-2" v-if="isAdmin">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.subjectPrice') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="number"
                           v-model="subject.price">
                </div>

                <div class="ui-mt-5">
                    <button type="button"
                            class="ui-button bg-green hover ui-color col-wite ui-fnt regular size-1"
                            @click="saveSubject()">
                        {{ trans('data.save') }}
                    </button>
                    <button type="button"
                            class="ui-button bg-grey hover ui-color col-wite ui-fnt regular size-1"
                            @click="$emit('close')">
                        {{ trans('data.cancel') }}
                    </button>
                </div>

            </div>
        </div>

    </div>
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
             * get subject
             */
            getSubject(id) {
                gql.getItem('v2', 'TaskSubjectQuery', ['id:' + id], 'subject')
                    .then(response => {
                        this.subject = response.data.data.TaskSubjectQuery[0];
                    })
            },

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
                return `
                    id: ${this.subject_id == 0 ? this.subject_id : subject.id},
                    name: "${subject.name || ''}"
                    price: ${subject.price || 0}`;
            }
        }
    }
</script>