<template>
    <section class="ui-mt-2">
        <b-table
                :data="stages"
                :hoverable=true
                :loading='tableLoading'
                :narrowed=true
                :paginated=false>

            <template slot-scope="props">
                <b-table-column :label="trans('data.stageName')">
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column :label="trans('data.access')" centered>
                    <div class="field">
                        <b-checkbox true-value="1" false-value="0" v-model="props.row.roles[0].access"
                                    @input="setStage(props.row.id,props.row.roles[0].access)"></b-checkbox>
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
    </section>
</template>
<script>
    export default {

        mounted() {
            this.getStages();
        },

        props: {
            role: {}
        },

        data() {
            return {
                stages: [],
                // table
                tableLoading: false
            }
        },

        methods: {

            /**
             * save stage access
             * @param id
             * @param access
             */
            setStage(id, access) {
                let param = {stage: id, role: this.role, access: access};
                Api.post('v1', 'saveStageRoleAccess', param)
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                    });
            },

            /**
             * get all stages
             */
            getStages() {
                this.tableLoading = true;
                Api.post('v1', 'getStages', {role: this.role})
                    .then(response => {
                        this.stages = response.data.data;
                        this.tableLoading = false;
                        this.selectStage = [];
                    });
            }

        }
    }
</script>