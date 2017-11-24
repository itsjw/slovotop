<template>
    <form action="">
        <div class="modal-card">
            <div class="notification is-warning" v-if="user_id == 0">
                <button type="button" class="delete"></button>
                {{ trans('data.informUseAdd') }}
            </div>
            <section class="modal-card-body">
                <b-field :label="trans('data.userName')">
                    <b-input
                            type="text"
                            v-model="user.name"
                            :placeholder="trans('data.userName')"
                            required>
                    </b-input>
                </b-field>

                <b-field :label="trans('data.userEmail')">
                    <b-input
                            type="email"
                            v-model="user.email"
                            :placeholder="trans('data.userEmail')"
                            required>
                    </b-input>
                </b-field>

                <b-field :label="trans('data.userPassword')">
                    <b-input
                            type="password"
                            v-model="user.password"
                            password-reveal
                            :placeholder="trans('data.userPassword')"
                            required>
                    </b-input>
                </b-field>

                <b-checkbox v-model="user.confirm"
                            true-value="1"
                            false-value="0">
                    {{ trans('data.userConfirm') }}
                </b-checkbox>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary">Login</button>
            </footer>
        </div>
    </form>
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
                gql.getItem('v2', 'UserQuery', ['id:' + id], 'user')
                    .then(response => {
                        this.user = response.data.data.UserQuery[0];
                        this.getCleanRole();
                    })
            },

            /**
             * get roles
             */
            getRoles() {
                gql.getItem('v2', 'RoleQuery', null, 'role')
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

                gql.setItem('v2', point, this.getUserData(this.user))
                    .then(response => {
                        if (response.data.errors) {
                            notify.make('alert', response.data.errors[0].validation);
                        } else {
                            notify.make('success', response.data.data[point].notify, 2);
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