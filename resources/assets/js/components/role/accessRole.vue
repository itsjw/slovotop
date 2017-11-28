<template>
    <section>
        <div class="modal-card bg bg-wite">
            <div class="section">
                <header class="modal-card-head">
                    <p class="modal-card-title">
                        {{ trans('data.roleTitle') }}
                        <strong>{{ role.name }}</strong>
                    </p>
                </header>

                <b-tabs type="is-boxed" class="ui-mt-3">
                    <b-tab-item :label="trans('data.titleMenu')"
                                icon-pack="fa"
                                icon="bars"></b-tab-item>
                    <b-tab-item :label="trans('data.roleStage')"
                                icon-pack="fa"
                                icon="tasks"></b-tab-item>
                </b-tabs>
            </div>
        </div>
    </section>
</template>
<script>
    Vue.component('accessTabMenu', require('./accessTabMenu.vue'));
    Vue.component('accessTabStage', require('./accessTabStage.vue'));

    export default {

        mounted() {
        },

        props: {},

        data() {
            return {
                tabs: ['active', ''],
                role: this.$parent.props || 0
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