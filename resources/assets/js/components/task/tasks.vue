<template>
    <div>

        <div class="ui-navbar ui-mb-5" v-if="accessMenu == 2">
            <ul>
                <li @click="addTask()">
                    <i class="ui-icon ui-mr-2">receipt</i>
                    <span>{{ trans('data.add') }}</span>
                </li>
                <li @click="editTask()">
                    <i class="ui-icon ui-mr-2">edit</i>
                    <span>{{ trans('data.edit') }}</span>
                </li>
                <li @click="deleteTask()">
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

            /**
             * gel all tasks
             */
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