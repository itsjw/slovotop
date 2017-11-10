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

    </div>
</template>
<script>
    export default {

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {}
        },

        methods: {
            addTask() {
            },
            editTask() {
            },
            deleteTask() {
            }
        }
    }
</script>