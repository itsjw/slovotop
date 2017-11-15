<template>
    <div class="ui-mt-5 animated fadeIn">

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
                        <input type="checkbox" :id="key" :value="val.id" v-model="selectSubject"/>
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

    </div>
</template>
<script>
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
            },

            /**
             * edit stage
             */
            editStage() {
            },

            /**
             * delete stage
             */
            deleteStage() {
            }
        }
    }
</script>