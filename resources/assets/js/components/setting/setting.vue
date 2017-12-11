<template>
    <section>

        <b-tabs type="is-boxed">
            <b-tab-item :label="trans('data.setTaskMain')"
                        icon-pack="fa"
                        icon="cogs">
                <setting-general></setting-general>
            </b-tab-item>

            <b-tab-item :label="trans('data.setTaskStage')"
                        icon-pack="fa"
                        icon="tasks">
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