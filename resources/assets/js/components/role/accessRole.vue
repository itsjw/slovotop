<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w50 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">

                <div class="ui-grid-block ui-fnt medium size-3 ui-color col-greyBlue ui-mb-3">
                    {{ trans('data.roleTitle') }}
                    <span class="ui-color col-orange ui-fnt size-4 ui-ml-2">{{ role.name }}</span>
                </div>

                <div class="ui-grid-block ui-fnt medium size-2">
                    <div class="ui-grid-2 center ui-bg bg-blue hover ui-color col-wite ui-pt-2 ui-pb-2"
                         :class="tabs[0]"
                         @click="selectTab(0)">
                        {{ trans('data.titleMenu') }}
                    </div>
                    <div class="ui-grid-3 center ui-bg bg-blue hover ui-color col-wite ui-pt-2 ui-pb-2"
                         :class="tabs[1]"
                         @click="selectTab(1)">
                        {{ trans('data.titleProject') }}
                    </div>
                    <div class="ui-grid-2 center ui-bg bg-blue hover ui-color col-wite ui-pt-2 ui-pb-2"
                         :class="tabs[2]"
                         @click="selectTab(2)">
                        {{ trans('data.titleTasks') }}
                    </div>
                    <div class="ui-grid-3 center ui-bg bg-blue hover ui-color col-wite ui-pt-2 ui-pb-2"
                         :class="tabs[3]"
                         @click="selectTab(3)">
                        {{ trans('data.titleDoc') }}
                    </div>
                    <div class="ui-grid-2 center ui-bg bg-blue hover ui-color col-wite ui-pt-2 ui-pb-2"
                         :class="tabs[4]"
                         @click="selectTab(4)">
                        {{ trans('data.titleReports') }}
                    </div>
                </div>

                <access-tab-menu :role="role_id"
                                 v-if="tabs[0]"></access-tab-menu>

                <access-tab-doc :role="role_id"
                                v-if="tabs[3]"></access-tab-doc>

            </div>
        </div>

    </div>
</template>
<script>
    Vue.component('accessTabMenu', require('./accessTabMenu.vue'));
    Vue.component('accessTabDoc', require('./accessTabDoc.vue'));

    export default {

        mounted() {
            this.getRole();
        },

        props: {
            role_id: {},
        },

        data() {
            return {
                tabs: ['active', '', '', '', ''],
                role: {}
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

            getRole() {
                gql.getItem('v2', 'RoleQuery', ['id:' + this.role_id], 'role')
                    .then(response => {
                        this.role = response.data.data.RoleQuery[0];
                    })
            }
        }
    }
</script>