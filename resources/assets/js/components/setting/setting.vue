<template>
    <section>

        <b-tabs @change="change">
            <b-tab-item :label="trans('data.setTaskMain')"
                        icon="settings">
            </b-tab-item>

            <b-tab-item :label="trans('data.setTaskStage')"
                        icon="format-list-numbers">
                <setting-stages v-if="tabActive == 1"></setting-stages>
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
                tabActive: 0
            }
        },

        methods: {
            /**
             * show active tab
             * @param index
             */
            change(index) {
                this.tabActive = index;
            }
        }
    }
</script>