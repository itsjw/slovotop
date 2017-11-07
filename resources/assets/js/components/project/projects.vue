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
                <th width="30%" class="left">
                    <div class="ui-grid-block">

                        <search-pop
                            v-if="showSearchName"
                            position="left"
                            type="name"
                            @submit="search"
                            @close="closePopUp()"></search-pop>


                        <i class="ui-icon ui-color col-orange hover ui-fnt size-3 ui-mr-1"
                           @click="showSearchName=true">search</i>
                        <i class="ui-icon ui-color col-red hover ui-fnt size-3 ui-mr-1"
                           v-show="queryParams[1]"
                           @click="search()">close</i>
                        <span>{{ trans('data.projectName') }}</span>

                    </div>
                </th>
                <th width="20%" class="left">
                    <div class="ui-grid-block">

                        <search-pop
                            v-if="showSearchSite"
                            position="left"
                            type="site"
                            @submit="search"
                            @close="closePopUp()"></search-pop>


                        <i class="ui-icon ui-color col-orange hover ui-fnt size-3 ui-mr-1"
                           @click="showSearchSite=true">search</i>
                        <i class="ui-icon ui-color col-red hover ui-fnt size-3 ui-mr-1"
                           v-show="queryParams[1]"
                           @click="search()">close</i>
                        <span>{{ trans('data.projectSite') }}</span>

                    </div>
                </th>
                <th width="20%" class="left">
                    <div class="ui-grid-block">

                        <search-pop
                            v-if="showSearchOwner"
                            position="left"
                            type="owner"
                            @submit="search"
                            @close="closePopUp()"></search-pop>


                        <i class="ui-icon ui-color col-orange hover ui-fnt size-3 ui-mr-1"
                           @click="showSearchOwner=true">search</i>
                        <i class="ui-icon ui-color col-red hover ui-fnt size-3 ui-mr-1"
                           v-show="queryParams[1]"
                           @click="search()">close</i>
                        <span>{{ trans('data.projectUser') }}</span>

                    </div>
                </th>
                <th width="10%">{{ trans('data.created_at') }}</th>
                <th width="10%">{{ trans('data.updated_at') }}</th>
                <th width="5%">
                    <div class="ui-grid-block center">
                        <i class="ui-icon ui-color col-orange hover ui-fnt size-1 ui-mr-1"
                           @click="orderByID()">sort</i>
                        <span>ID</span>
                    </div>
                </th>
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
                     :user_id="user_id"
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

        props: {
            user_id: {
                default: 0
            }
        },

        data() {
            return {
                showAddProject: false,
                projects: {},
                selectProject: [],
                showSearchName: false,
                showSearchSite: false,
                showSearchOwner: false,
                order: 'asc',
                queryParams: ['orderID:"asc"'],
            }
        },

        methods: {
            /**
             * unescape data
             */
            unescape(data) {
                return _.unescape(data);
            },

            /**
             * close popup
             */
            closePopUp() {
                this.showAddProject = false;
                this.showSearchName = false;
                this.showSearchSite = false;
                this.showSearchOwner = false;
                this.getProjects();
            },

            /**
             * order by ID
             */
            orderByID() {
                if (this.order === 'asc') {
                    this.queryParams.splice(0, 1, 'orderID:"desc"');
                    this.order = 'desc';
                } else {
                    this.queryParams.splice(0, 1, 'orderID:"asc"');
                    this.order = 'asc';
                }
                this.getProjects();
            },

            /**
             * search my type and value
             * @param value
             * @param type
             */
            search(value, type) {
                this.queryParams.splice(1, 1);

                if (value) {
                    this.queryParams.splice(1, 1, '' + type + ':"' + value + '"');
                }
                this.closePopUp();
            },

            /**
             * get all projects
             */
            getProjects() {
                this.selectProject = [];
                gql.getItem('v1', 'ProjectQuery', this.queryParams, 'project')
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
                    gql.setItem('v1', 'DeleteProjectMutation', select)
                        .then(response => {
                            notify.make('seccess', response.data.data.DeleteProjectMutation.id,1);
                            this.getProjects();
                        })
                }
            }
        }
    }
</script>