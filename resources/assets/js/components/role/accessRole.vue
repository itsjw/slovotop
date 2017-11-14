<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w50 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">

                <div class="ui-grid-block ui-fnt medium size-3 ui-color col-greyBlue ui-mb-5">
                    {{ trans('data.roleTitle') }}
                    <span class="ui-color col-orange ui-fnt size-4 ui-ml-2">{{ role.name }}</span>
                </div>

                <div class="ui-tabs-box">
                    <ul>
                        <li :class="tabs[0]" @click="selectTab(0)">
                            <i class="ui-icon ui-mr-2">settings</i>
                            <span>{{ trans('data.titleMenu') }}</span>
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