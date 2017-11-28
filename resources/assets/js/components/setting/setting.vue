<template>
    <section>

        <b-tabs type="is-boxed">
            <b-tab-item :label="trans('data.setTaskMain')"
                        icon-pack="fa"
                        icon="cogs"></b-tab-item>

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