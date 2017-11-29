<template>
    <section>
        <div class="modal-card bg bg-wite">
            <div class="section">
                <b-table
                        :data="stageAccess"
                        :hoverable=true
                        :loading='tableLoading'
                        :narrowed=true
                        :paginated=false>

                    <template slot-scope="props">
                        <b-table-column field="name" :label="trans('data.taskField')" sortable>
                            {{ props.row.lang }}
                        </b-table-column>

                        <b-table-column :label="trans('data.read')" centered>
                            <div class="field">
                                <b-checkbox true-value="1" v-model="props.row.access"
                                            @input="selectField(props.row.name,props.row.access)"></b-checkbox>
                            </div>
                        </b-table-column>

                        <b-table-column :label="trans('data.write')" centered>
                            <div class="field">
                                <b-checkbox true-value="2" v-model="props.row.access"></b-checkbox>
                            </div>
                        </b-table-column>

                        <b-table-column :label="trans('data.hide')" centered>
                            <div class="field">
                                <b-checkbox true-value="0" v-model="props.row.access"></b-checkbox>
                            </div>
                        </b-table-column>
                    </template>

                    <template slot="empty">
                        <section class="section">
                            <div class="content has-text-grey has-text-centered">
                                <p>
                                    <b-icon
                                            icon="ban"
                                            icon-pack="fa"
                                            size="is-large">
                                    </b-icon>
                                </p>
                                <p>{{ trans('data.searchNull') }}</p>
                            </div>
                        </section>
                    </template>
                </b-table>
            </div>
        </div>
    </section>
</template>

<style scoped>
    .section {
        overflow: auto
    }
</style>

<script>
    export default {

        mounted() {
            this.getStageAccess();
        },

        props: {},

        data() {
            return {
                stage: this.$parent.props.id,
                stageAccess: [],
                // table
                tableLoading: false
            }
        },

        methods: {

            /**
             * set access stage task field
             * @param field
             * @param access
             */
            selectField(field, access) {
                let param = {field: field, stage: this.stage, access: access};

                Api.post('v1', 'saveStageTaskAccess', param)
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
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
             * get task fields
             */
            getStageAccess() {
                this.tableLoading = true;
                Api.post('v1', 'getStageTaskAccess', {stage: this.stage})
                    .then(response => {
                        this.stageAccess = response.data;
                        this.tableLoading = false;
                    })
            },
        }
    }
</script>