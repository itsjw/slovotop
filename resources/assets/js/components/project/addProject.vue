<template>

    <form @submit.prevent="saveProject()">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    {{ trans('data.projectProject') }}
                </p>
            </header>
            <section class="modal-card-body">
                <b-field :label="trans('data.projectName')">
                    <b-input
                            type="text"
                            v-model="project.name"
                            :placeholder="trans('data.projectName')"
                            required>
                    </b-input>
                </b-field>

                <b-field :label="trans('data.projectSite')">
                    <b-input
                            type="text"
                            v-model="project.site"
                            :placeholder="trans('data.projectSite')"
                            required>
                    </b-input>
                </b-field>

                <b-field :label="trans('data.projectUser')" v-if="isAdmin">
                    <b-select :placeholder="trans('data.projectUser')"
                              v-model="project.user.id"
                              icon-pack="fa" icon="user" required>
                        <option
                                v-for="val in users"
                                :value="val.id"
                                :key="val.id">
                            {{ val.name }}
                        </option>
                    </b-select>
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
            this.getUsers();

            if (this.projectProp.id > 0) {
                this.project = _.cloneDeep(this.projectProp);
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
                projectProp: this.$parent.props || 0,
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
                if (this.isAdmin) {
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
                Api.post('v1', 'getUsers')
                    .then(response => {
                        this.users = response.data.data;
                    });
            },

            /**
             * save project
             */
            saveProject() {
                Api.post('v1', 'saveProject', this.getProjectData(this.project))
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.$parent.close();
                        this.$root.$children[0].getProjects();
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
             * get project data
             * @param project
             * @return {string}
             */
            getProjectData(project) {
                return {
                    id: project.id || 0,
                    name: project.name || '',
                    site: _.escape(project.site) || '',
                    user_id: this.getUser
                }
            }
        }

    }
</script>