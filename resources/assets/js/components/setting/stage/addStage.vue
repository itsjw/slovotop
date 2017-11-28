<template>

    <form @submit.prevent="saveStage()">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    {{ trans('data.stageName') }}
                </p>
            </header>
            <section class="modal-card-body">
                <b-field :label="trans('data.stageName')">
                    <b-input
                            type="text"
                            v-model="stage.name"
                            :placeholder="trans('data.stageName')"
                            required>
                    </b-input>
                </b-field>

                <b-field :label="trans('data.stagePriority')">
                    <b-input
                            type="number"
                            v-model="stage.priority"
                            min="1"
                            :placeholder="trans('data.stagePriority')"
                            required>
                    </b-input>
                </b-field>

                <b-field :label="trans('data.stagePrice')">
                    <b-input
                            type="number"
                            v-model="stage.price"
                            :placeholder="trans('data.stagePrice')"
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
            if (this.stageProp.id > 0) {
                this.stage = _.cloneDeep(this.stageProp);
            }
        },

        props: {},

        data() {
            return {
                stageProp: this.$parent.props || 0,
                stage: {}
            }
        },

        methods: {

            /**
             * save stage
             */
            saveStage() {
                Api.post('v1', 'saveStage', this.getStageData(this.stage))
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.$parent.close();
                        this.$root.$children[0].getStages();
                    })
                    .catch(error => {
                        this.$toast.open({
                            duration: 5000,
                            message: Api.errorSerializer(error.response.data.errors),
                            type: 'is-danger'
                        });
                    });
            },

            /**
             * get stage data
             * @param stage
             * @return {string}
             */
            getStageData(stage) {
                return {
                    id: stage.id || 0,
                    name: stage.name || '',
                    priority: stage.priority || 0,
                    price: stage.price || 0
                };
            }
        }
    }
</script>