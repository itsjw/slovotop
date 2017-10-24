<template>
    <div>
        <div class="ui-grid-block ui-bg bg-blue ui-mb-3 ui-p-1">
            <div class="ui-grid-6 ui-grid-block">
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="addProject()">
                    <i class="ui-icon size-4">note_add</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.add') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="editProject()">
                    <i class="ui-icon size-4">edit</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.edit') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="deleteProject()">
                    <i class="ui-icon">delete</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.delete') }}</span>
                </div>
            </div>
            <div class="ui-grid-6"></div>
        </div>

        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="1%">
                    <i class="ui-icon size-3 ui-color col-green hover"
                       @click="getProjects()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="30%" class="left">{{ trans('data.projectName') }}</th>
                <th width="20%" class="left">{{ trans('data.projectSite') }}</th>
                <th width="20%" class="left">{{ trans('data.projectUser') }}</th>
                <th width="10%">{{ trans('data.created_at') }}</th>
                <th width="10%">{{ trans('data.updated_at') }}</th>
                <th width="5%">ID</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in projects"
                @click="selectProjects(val.id)">
                <td>
                    <input type="checkbox" :id="key" :value="val.id" v-model="selectProject"/>
                    <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td class="left">{{ unescape(val.site) }}</td>
                <td class="left">{{ val.user.name }}</td>
                <td>{{ val.created_at }}</td>
                <td>{{ val.updated_at }}</td>
                <td>{{ val.id }}</td>
            </tr>
            </tbody>
        </table>

        <add-project :project_id="selectProject[0]"
                     v-if="showAddProject"
                     v-on:close="closePopUp()"></add-project>

    </div>
</template>
<script>
    Vue.component('addProject', require('./addProject.vue'));

    export default {

        mounted() {
            this.getProjects()
        },

        props: [],

        data() {
            return {
                showAddProject: false,
                projects: {},
                selectProject: []
            }
        },

        methods: {
            /**
             *
             */
            unescape(data) {
                return _.unescape(data);
            },

            /**
             * close popup
             */
            closePopUp() {
                this.showAddProject = false;
                this.getProjects();
            },

            /**
             * get all projects
             */
            getProjects() {
                this.selectProject = [];
                gql.getItem('v1', 'ProjectQuery', false, 'project')
                    .then(response => {
                        this.projects = response.data.data.ProjectQuery;
                    })
            },

            /**
             * select users
             * @param id
             */
            selectProjects(id) {
                if (this.selectProject.indexOf(id) == -1) {
                    this.selectProject.push(id);
                } else {
                    this.selectProject.splice(this.selectProject.indexOf(id), 1);
                }
            },

            /**
             * add project
             */
            addProject() {
                this.selectProject = [];
                this.showAddProject = true;
            },

            /**
             * edit project
             */
            editProject() {
                if (this.selectProject.length > 0) {
                    this.showAddProject = true;
                }
            },

            /**
             * delete project
             */
            deleteProject() {
                let select;
                if (this.selectProject.length > 0) {
                    if (confirm('Удалить?')) {
                        select = ['items:"' + this.selectProject + '"'];
                    }
                    gql.setItem('v1', 'DeleteProject', select)
                        .then(response => {
                            this.getProjects();
                        })
                }
            }
        }
    }
</script>