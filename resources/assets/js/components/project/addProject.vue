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
                    <select class="ui-input green focus ui-fnt light size-1"
                            v-model="project.user.id"
                            v-if="user_id == 0">
                        <option v-for="(val,key) in users" :value="val.id">
                            {{ val.name }}
                        </option>
                    </select>
                </div>
                <div class="ui-mt-5">
                    <button type="button"
                            class="ui-button bg-green hover ui-color col-wite ui-fnt regular size-1"
                            @click="saveProject()">
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
            if (this.project_id > 0) {
                this.getProject(this.project_id);
            }
            if (this.user_id == 0) {
                this.getUsers();
            }
        },

        props: {
            project_id: {
                default: 0
            },
            user_id: {
                default: 0
            }
        },

        data() {
            return {
                project: {
                    user: {}
                },
                users: []
            }
        },

        computed: {
            /**
             * get user ID
             */
            getUser() {
                if (this.user_id === 0) {
                    return this.project.user.id || 0;
                }
                return this.user_id;
            }
        },

        methods: {
            /**
             * get all users
             */
            getUsers() {
                gql.getItem('v1', 'UserQuery', false, 'user')
                    .then(response => {
                        this.users = response.data.data.UserQuery;
                    });
            },

            /**
             * get project
             * @param id
             */
            getProject(id) {
                gql.getItem('v1', 'ProjectQuery', ['id:' + id], 'project')
                    .then(response => {
                        this.project = response.data.data.ProjectQuery[0];
                        this.project.site = _.unescape(response.data.data.ProjectQuery[0].site);
                    })
            },

            /**
             * save project
             */
            saveProject() {
                gql.setItem('v1', 'AddProjectMutation', this.getProjectData(this.project))
                    .then(response => {
                        if (response.data.errors) {
                            notify.make('alert', response.data.errors[0].validation);
                        } else {
                            notify.make('success', response.data.data.AddProjectMutation.id,2);
                            this.$emit('close');
                        }
                    });
            },

            /**
             * get project data
             * @param project
             * @return {string}
             */
            getProjectData(project) {
                return `
                    id: ${this.project_id == 0 ? this.project_id : project.id},
                    name: "${project.name || ''}",
                    site: "${_.escape(project.site) || ''}",
                    user_id: ${this.getUser}`;
            },
        }

    }
</script>