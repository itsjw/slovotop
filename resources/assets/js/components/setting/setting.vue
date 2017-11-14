<template>
    <div>

        <div class="ui-grid-block ui-bg bg-wite ui-p-3">

            <div class="ui-tabs-box">
                <ul>
                    <li :class="tabs[0]" @click="selectTab(0)">
                        <i class="ui-icon ui-mr-2">settings</i>
                        <span>{{ trans('data.setTaskStatus') }}</span>
                    </li>
                    <li :class="tabs[1]" @click="selectTab(1)">
                        <i class="ui-icon ui-mr-2">view_carousel</i>
                        <span>{{ trans('data.titleProject') }}</span>
                    </li>
                    <li :class="tabs[2]" @click="selectTab(2)">
                        <i class="ui-icon ui-mr-2">receipt</i>
                        <span>{{ trans('data.titleTasks') }}</span>
                    </li>
                    <li :class="tabs[3]" @click="selectTab(3)">
                        <i class="ui-icon ui-mr-2">insert_drive_file</i>
                        <span> {{ trans('data.titleDoc') }}</span>
                    </li>
                    <li :class="tabs[4]" @click="selectTab(4)">
                        <i class="ui-icon ui-mr-2">view_list</i>
                        <span>{{ trans('data.titleReports') }}</span>
                    </li>
                </ul>
            </div>



        </div>

    </div>
</template>
<script>
    export default {

        mounted() {
        },

        props: [],

        data() {
            return {
                tabs: ['active', '', '', '', ''],
            }
        },

        methods: {
            /**
             * select tabs
             * @param key
             */
            selectTab(key) {
                this.tabs = ['', '', '', '', ''];
                this.tabs.splice(key, 0, 'active');
            },

        }
    }
</script>