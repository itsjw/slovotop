<template>
    <div class="ui-grid-block ui-mt-5 animated fadeIn">

        <div class="ui-navbar ui-mb-5" v-if="accessMenu == 2">
            <ul>
                <li @click="addStage()">
                    <i class="ui-icon ui-mr-2">navigate_next</i>
                    <span>{{ trans('data.add') }}</span>
                </li>
                <li @click="editStage()">
                    <i class="ui-icon ui-mr-2">edit</i>
                    <span>{{ trans('data.edit') }}</span>
                </li>
                <li @click="deleteStage()">
                    <i class="ui-icon ui-mr-2">delete</i>
                    <span>{{ trans('data.delete') }}</span>
                </li>
                <li @click="accessStage()">
                    <i class="ui-icon ui-mr-2">fingerprint</i>
                    <span>{{ trans('data.stageAccessTask') }}</span>
                </li>
            </ul>
        </div>

        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="1%">
                    <i class="ui-icon size-3 ui-color col-green hover"
                       @click="getStages()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="60%" class="left">
                    {{ trans('data.stageName') }}
                </th>
                <th width="30%">
                    {{ trans('data.stagePriority') }}
                </th>
                <th width="5%">ID</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in stages"
                @click="selectStages(val.id)">
                <td>
                    <div v-if="accessMenu == 2">
                        <input type="checkbox" :id="key" :value="val.id" v-model="selectStage"/>
                        <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                    </div>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td>{{ val.priority }}</td>
                <td>{{ val.id }}</td>
            </tr>
            </tbody>
        </table>

        <add-stage v-if="showAddStage"
                   :stage_id="selectStage[0]"
                   @close="closePopUp()"></add-stage>

        <access-task v-if="showAccessTask"
                     :stage_id="selectStage[0]"
                     @close="closePopUp()"></access-task>

    </div>
</template>
<script>
    Vue.component('addStage', require('./addStage.vue'));
    Vue.component('accessTask', require('./accessTask.vue'));

    export default {

        created() {
        },

        mounted() {
            this.getStages();
        },

        props: {},

        data() {
            return {
                showAddStage: false,
                showAccessTask: false,
                selectStage: [],
                stages: {}
            }
        },

        methods: {
            /**
             * close all pop up
             */
            closePopUp() {
                this.showAddStage = false;
                this.showAccessTask = false;
                this.getStages();
            },

            /**
             * select stage
             * @param id
             */
            selectStages(id) {
                if (this.selectStage.indexOf(id) == -1) {
                    this.selectStage.push(id);
                } else {
                    this.selectStage.splice(this.selectStage.indexOf(id), 1);
                }
            },

            /**
             * get all stages
             */
            getStages() {
                this.selectStage = [];
                gql.getItem('v2', 'TaskStageQuery', false, 'stage')
                    .then(response => {
                        this.stages = response.data.data.TaskStageQuery;
                    })
            },

            /**
             * add stage
             */
            addStage() {
                this.selectStage = [];
                this.showAddStage = true;
            },

            /**
             * edit stage
             */
            editStage() {
                if (this.selectStage.length > 0) {
                    this.showAddStage = true;
                }
            },

            /**
             * delete stage
             */
            deleteStage() {
                if (this.selectStage.length > 0) {
                    if (confirm('Удалить')) {
                        let select = ['items:"' + this.selectStage + '"'];

                        gql.setItem('v2', 'DeleteTaskStageMutation', select)
                            .then(response => {
                                notify.make('success', response.data.data.DeleteTaskStageMutation.notify, 1);
                                this.getStages();
                            })
                    }
                }
            },

            /**
             * set access to field task
             */
            accessStage() {
                if (this.selectStage.length > 0) {
                    this.showAccessTask = true;
                }
            }
        }
    }
</script>