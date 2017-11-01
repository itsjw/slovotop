<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w25 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">

                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.roleName') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="text"
                           v-model="role.name">
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.roleAccess') }}
                    </div>
                </div>

                <div class="ui-mb-2 ui-grid-block"
                v-for="(val,key) in menus">
                    <div class="ui-grid-10">
                        <div class="ui-fnt regular size-2 ui-color col-green">
                            {{ val.name }}
                        </div>
                    </div>
                    <div class="ui-grid-2">
                        <input type="checkbox" :id="'menu'+key"/>
                        <label :for="'menu'+key" class="ui-checkbox ui-color col-green"></label>
                    </div>
                </div>


                <div class="ui-mt-6">
                    <button type="button"
                            class="ui-button bg-blue hover ui-color col-wite ui-fnt regular size-2"
                            @click="saveRole()">
                        {{ trans('data.save') }}
                    </button>
                    <button type="button"
                            class="ui-button bg-grey hover ui-color col-wite ui-fnt regular size-2"
                            @click="$emit('close')">
                        {{ trans('data.cancel') }}
                    </button>
                </div>

                <div class="ui-mt-3">
                    <div class="ui-color col-red ui-fnt bold size-1 animated fadeIn"
                         v-for="(val,key) in errors">
                        {{ val[0] }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    export default {

        mounted() {
            if (this.role_id > 0) {
                this.getRole(this.role_id);
            }
            this.getMenus();
        },

        props: {
            role_id: {
                default: 0
            }
        },

        data() {
            return {
                role: {},
                errors: {},
                menus: {}
            }
        },

        methods: {
            /**
             * get role
             * @param id
             */
            getRole(id) {
                gql.getItem('v1', 'RoleQuery', ['id:' + id], 'role')
                    .then(response => {
                        this.role = response.data.data.RoleQuery[0];
                    })
            },

            /**
             * get menus
             */
            getMenus() {
                gql.getItem('v1', 'MenuQuery', false, 'menu')
                    .then(response => {
                        this.menus = response.data.data.MenuQuery;
                    })
            },

            /**
             * save project
             */
            saveRole() {
                gql.setItem('v1', 'AddRoleMutation', this.getRoleData(this.role))
                    .then(response => {
                        if (response.data.errors) {
                            this.errors = response.data.errors[0].validation;
                        } else {
                            this.$emit('close');
                        }
                    });
            },

            /**
             * get role data
             * @param role
             */
            getRoleData(role) {
                return `
                    id: ${this.role_id == 0 ? this.role_id : role.id},
                    name: "${role.name || ''}"`;
            }
        }
    }
</script>