<template>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">
                {{ trans('data.taskUser') }}
            </p>
        </header>
        <section class="modal-card-body">
            <b-field :label="trans('data.stageName')">
                <b-select :placeholder="trans('data.stageName')"
                          expanded
                          icon="account"
                          v-model="taskStep.stage.id">
                    <option
                            v-for="(val,key) in stages"
                            :value="val.id"
                            :key="key">
                        {{ val.name }}
                    </option>
                </b-select>
            </b-field>

            <b-field :label="trans('data.userUser')">
                <b-select :placeholder="trans('data.userUser')"
                          expanded
                          icon="account"
                          v-model="taskStep.user.id">
                    <option
                            v-for="(val,key) in users"
                            :value="val.id"
                            :key="key">
                        {{ val.name }}
                    </option>
                </b-select>
            </b-field>
        </section>

        <footer class="modal-card-foot">
            <button class="button" type="button" @click="$parent.close()">{{ trans('data.cancel') }}</button>
            <button class="button is-primary" type="button">{{ trans('data.save') }}</button>
        </footer>
    </div>
</template>

<script>
    export default {

        name: "add-task-step",

        mounted() {
            this.getUsers();
            this.getStages();
        },

        props: {},

        data() {
            return {
                stages: [],
                users: [],
                taskStep: {
                    user: {},
                    stage: {}
                }
            }
        },

        methods: {
            /**
             * get users
             */
            getUsers() {
                Api.post('v1', 'getUserList')
                    .then(response => {
                        this.users = response.data.data;
                    })
            },

            /**
             * get all stages
             */
            getStages() {
                Api.post('v1', 'getStageList')
                    .then(response => {
                        this.stages = response.data.data;
                    })
            }
        }
    }
</script>