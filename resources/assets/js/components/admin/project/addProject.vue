<template>
    <div>
        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w25 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.projectName') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="text"
                           v-model="project.name">
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.projectSite') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="text"
                           v-model="project.site">
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.projectUser') }}
                    </div>
                    <select class="ui-input green focus ui-fnt light size-1" v-model="project.user">
                        <option v-for="(val,key) in users" :value="val.id">
                            {{ val.name }}
                        </option>
                    </select>
                </div>
                <div class="ui-mt-5">
                    <button type="button"
                            class="ui-button bg-blue hover ui-color col-wite ui-fnt regular size-2"
                            @click="saveProject()">
                        {{ trans('data.save') }}
                    </button>
                    <button type="button"
                            class="ui-button bg-grey hover ui-color col-wite ui-fnt regular size-2"
                            @click="$emit('close')">
                        {{ trans('data.cancel') }}
                    </button>
                </div>

                <div class="ui-mt-3">
                    <div class="ui-color col-red ui-fnt bold size-1 animated fadeIn"
                         v-for="(val,key) in errors">
                        {{ val[0] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        mounted() {
            this.getUsers();
        },

        props: {
            project_id: {
                default: 0
            }
        },

        data() {
            return {
                project: {},
                errors: {},
                users: []
            }
        },

        methods: {

            /**
             * get all users
             */
            getUsers() {
                this.selectUser = [];
                gql.getItem('v1', 'UserQuery', false, 'user')
                    .then(response => {
                        this.users = response.data.data.UserQuery;
                    })
            }

        }
    }
</script>