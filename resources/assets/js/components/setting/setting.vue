<template>
    <div>

        <div class="ui-grid-block ui-bg bg-wite ui-p-3">

            <div class="ui-tabs-box">
                <ul>
                    <li :class="tabs[0]" @click="selectTab(0)">
                        <i class="ui-icon ui-mr-2">settings</i>
                        <span>{{ trans('data.setTaskMain') }}</span>
                    </li>
                    <li :class="tabs[1]" @click="selectTab(1)">
                        <i class="ui-icon ui-mr-2">navigate_next</i>
                        <span>{{ trans('data.setTaskStage') }}</span>
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
                tabs: ['active', ''],
            }
        },

        methods: {
            /**
             * select tabs
             * @param key
             */
            selectTab(key) {
                this.tabs = ['', ''];
                this.tabs.splice(key, 0, 'active');
            },

        }
    }
</script>