<template>
    <div>

        <div class="ui-grid-block ui-bg bg-blue ui-mb-3 ui-p-1" v-if="accessMenu == 2">
            <div class="ui-grid-6 ui-grid-block">
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="addTask()">
                    <i class="ui-icon size-4">receipt</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.add') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="editTask()">
                    <i class="ui-icon size-4">edit</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.edit') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="deleteTask()">
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
                       @click="getTasks()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="20%" class="left">{{ trans('data.taskName') }}</th>
                <th width="20%">{{ trans('data.projectName') }}</th>
                <th width="10%">{{ trans('data.taskState') }}</th>
                <th width="10%">{{ trans('data.taskUser') }}</th>
                <th width="10%">{{ trans('data.taskOwner') }}</th>
                <th width="10%">{{ trans('data.created_at') }}</th>
                <th width="10%">{{ trans('data.updated_at') }}</th>
                <th width="5%">ID</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in tasks"
                @click="selectTasks(val.id)">
                <td>
                    <div v-if="isAdmin">
                        <input type="checkbox" :id="key" :value="val.id" v-model="selectTask"/>
                        <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                    </div>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td>{{ val.count }}</td>
                <td>{{ val.created_at }}</td>
                <td>{{ val.updated_at }}</td>
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
        },

        props: {
            user_id: {}
        },

        data() {
            return {
                selectTask: [],
                tasks: {}
            }
        },

        methods: {
            selectTasks(id) {
            },
            getTasks() {
            },

            /**
             * add task
             */
            addTask() {
                window.location = '/crm/tasks/task/';
            },
            editTask() {
            },
            deleteTask() {
            }
        }
    }
</script>