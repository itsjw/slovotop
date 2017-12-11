<template>
    <section>

        <b-tabs>
            <b-tab-item :label="trans('data.setTaskMain')"
                        icon="settings">
                <setting-general></setting-general>
            </b-tab-item>

            <b-tab-item :label="trans('data.setTaskStage')"
                        icon="format-list-numbers">
                <setting-stages></setting-stages>
            </b-tab-item>
        </b-tabs>

    </section>
</template>
<script>
    Vue.component('settingStages', require('./stage/stages.vue'));
    Vue.component('settingGeneral', require('./main/general'));

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