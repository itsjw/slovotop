<template>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">
                {{ trans('data.roleRoles') }}
            </p>
        </header>
        <section class="modal-card-body">
            <b-field :label="trans('data.roleName')">
                <b-input
                        type="text"
                        v-model="role.name"
                        :placeholder="trans('data.roleName')"
                        required>
                </b-input>
            </b-field>
        </section>

        <footer class="modal-card-foot">
            <button class="button" type="button" @click="$parent.close()">{{ trans('data.cancel') }}</button>
            <button class="button is-primary" type="submit">{{ trans('data.save') }}</button>
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
                users: []
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