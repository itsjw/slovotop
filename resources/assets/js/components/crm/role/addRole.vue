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

                <div class="ui-mt-5">
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
        },

        props: {
            role_id: {
                default: 0
            }
        },

        data() {
            return {
                role: {},
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
             * save project
             */
            saveRole() {
                gql.setItem('v1', 'AddRoleMutation', this.getRoleData(this.role))
                    .then(response => {
                        if (response.data.errors) {
                            notify.make('alert', response.data.errors[0].validation);
                        } else {
                            notify.make('success', response.data.data.AddRoleMutation.id);
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