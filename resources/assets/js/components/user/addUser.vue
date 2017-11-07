<template>
    <div>
        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w400 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">
                <div class="ui-inform bg-cyan ui-color col-wite ui-mb-1 ui-fnt light size-1"
                     v-if="user_id == 0">
                    {{ trans('data.informUseAdd') }}
                </div>

                <div class="ui-mb-1">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userName') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="text"
                           v-model="user.name">
                </div>
                <div class="ui-mb-1">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userEmail') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="email"
                           v-model="user.email">
                </div>
                <div class="ui-mb-1">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userPassword') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="password"
                           v-model="user.password">
                </div>
                <div class="ui-mb-1 ui-block-flex">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mr-2">
                        {{ trans('data.userConfirm') }}
                    </div>
                    <input type="checkbox" id="conf"
                           v-model="user.confirm"
                           v-bind:true-value="1"
                           v-bind:false-value="0"/>
                    <label for="conf" class="ui-checkbox ui-color col-green hover"></label>
                </div>
                <div class="ui-mb-1">
                    <div class="ui-block-flex">

                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-block-flex">
                            <span class="ui-pr-2">{{ trans('data.userRole') }}</span>
                            <i class="ui-icon size-5 ui-color col-green hover"
                               @click="getRoles()">add_circle</i>

                            <div class="ui-popup-bg" @click="showRoles=false" v-if="showRoles"></div>
                            <div class="ui-popup ui-bg bg-wite" v-if="showRoles">
                                <table>
                                    <tbody>
                                    <tr v-for="(val,key) in roles"
                                        class="hover ui-fnt regular size-1 ui-color col-blue">
                                        <td class="left" @click="addRole(key)">{{ val.name }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div v-for="(item,k) in user.roles"
                             class="ui-tag bg-greyL hover ui-fnt regular size-1 ui-color col-greyBlue ui-block-flex ui-m-1 animated fadeIn">
                            {{ item.role.name }}
                            <i class="ui-icon size-2 ui-ml-2 ui-color col-red hover"
                               @click="deleteRole(k)">close</i>
                        </div>
                    </div>
                </div>
                <div class="ui-mb-1">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userUpPrice') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="number"
                           v-model="user.up_price">
                </div>
                <div class="ui-mb-1">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userNote') }}
                    </div>
                    <textarea class="ui-input green focus ui-fnt light size-1"
                              v-model="user.note"></textarea>
                </div>


                <div class="ui-mt-3">
                    <button type="button"
                            class="ui-button bg-green hover ui-color col-wite ui-fnt regular size-1"
                            @click="saveUser()">
                        {{ trans('data.save') }}
                    </button>
                    <button type="button"
                            class="ui-button bg-grey hover ui-color col-wite ui-fnt regular size-1"
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
            if (this.user_id > 0) {
                this.getUser(this.user_id);
            }
        },

        props: {
            user_id: {
                default: 0,
            }
        },

        data() {
            return {
                showRoles: false,
                user: {
                    confirm: 1,
                    roles: []
                },
                roles: [],
                cleanRole: []
            }
        },

        methods: {
            /**
             * get user
             * @param id
             */
            getUser(id) {
                gql.getItem('v1', 'UserQuery', ['id:' + id], 'user')
                    .then(response => {
                        this.user = response.data.data.UserQuery[0];
                        this.getCleanRole();
                    })
            },

            /**
             * get roles
             */
            getRoles() {
                gql.getItem('v1', 'RoleQuery', null, 'role')
                    .then(response => {
                        this.roles = response.data.data.RoleQuery;
                        this.showRoles = true;
                    })
            },

            /**
             * add user role
             * @param id
             */
            addRole(id) {
                this.showRoles = false;
                if (this.cleanRole.indexOf(this.roles[id].id) == -1) {
                    this.user.roles.push({
                        'id': this.roles[id].id,
                        'role': {
                            'id': this.roles[id].id,
                            'name': this.roles[id].name
                        }
                    });
                }
                this.getCleanRole();
            },

            /**
             * delete role
             * @param id
             */
            deleteRole(id) {
                this.user.roles.splice(id, 1);
                this.getCleanRole();
            },

            /**
             * save user
             */
            saveUser() {
                let point = 'AddUserMutation';

                if (this.user_id) {
                    point = 'UpdateUserMutation';
                }

                gql.setItem('v1', point, this.getUserData(this.user))
                    .then(response => {
                        if (response.data.errors) {
                            notify.make('alert', response.data.errors[0].validation);
                        } else {
                            notify.make('success', response.data.data[point].id,2);
                            this.$emit('close');
                        }
                    });
            },

            /**
             * get user data
             * @param user
             * @return {string}
             */
            getUserData(user) {

                return `
                    id: ${this.user_id == 0 ? this.user_id : user.id},
                    name: "${user.name || ''}",
                    email: "${user.email || ''}",
                    up_price: ${user.up_price || 0},
                    note: "${_.unescape(user.note) || ''}",
                    role: "${this.cleanRole || ''}",
                    confirm: ${parseInt(user.confirm)},
                    password: "${user.password || ''}"`;
            },

            /**
             * get clean role
             * @param role
             */
            getCleanRole() {
                let _vm = this;
                this.cleanRole = [];

                _.forEach(this.user.roles, function (value) {
                    _vm.cleanRole.push(value.role.id);
                });

            }
        }
    }
</script>