<template>

    <form @submit.prevent="saveUser()">
        <div class="modal-card">
            <b-message title="Info" type="is-info" has-icon v-if="userProp == 0">
                {{ trans('data.informUseAdd') }}
            </b-message>
            <header class="modal-card-head">
                <p class="modal-card-title">
                    {{ trans('data.userUser') }}
                </p>
            </header>
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
                            :placeholder="trans('data.userPassword')">
                    </b-input>
                </b-field>

                <b-checkbox v-model="user.confirm"
                            true-value="1"
                            false-value="0">
                    {{ trans('data.userConfirm') }}
                </b-checkbox>

                <section class="ui-mt-2">

                    <div class="columns">
                        <div class="column is-2">
                            <b-dropdown position="is-top-right">
                                <button type="button" class="button is-link" slot="trigger">
                                    <span>{{ trans('data.userRole') }}</span>
                                    <b-icon pack="fa" icon="angle-up"></b-icon>
                                </button>

                                <b-dropdown-item v-for="(val,id) in roles" :key=val.id @click="addRole(id)">
                                    {{ val.name }}
                                </b-dropdown-item>
                            </b-dropdown>
                        </div>
                        <div class="column">
                            <div class="field is-grouped is-grouped-multiline">
                                <div class="control" v-for="(item,k) in user.roles">
                                    <div class="tags has-addons">
                                        <a class="tag is-warning">{{ item.name }}</a>
                                        <a class="tag is-delete" @click="deleteRole(k)"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

                <b-field :label="trans('data.userUpPrice')">
                    <b-input
                            type="number"
                            v-model="user.up_price"
                            :placeholder="trans('data.userUpPrice')">
                    </b-input>
                </b-field>

                <b-field :label="trans('data.userNote')">
                    <b-input maxlength="200" type="textarea" v-model="user.note"></b-input>
                </b-field>

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">{{ trans('data.cancel') }}</button>
                <button class="button is-primary" type="submit">{{ trans('data.save') }}</button>
            </footer>
        </div>
    </form>

</template>

<style scoped>
    .tag {
        cursor: pointer;
    }
</style>

<script>
    export default {

        mounted() {
            if (this.userProp.id > 0) {
                this.user = _.cloneDeep(this.userProp);
                this.getCleanRole();
            }
            this.getRoles();
        },

        props: {},

        data() {
            return {
                userProp: this.$parent.props || 0,
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
             * get roles
             */
            getRoles() {
                Api.post('v1', 'getRoles')
                    .then(response => {
                        this.roles = response.data.data;
                    })
            },

            /**
             * add user role
             * @param id
             */
            addRole(id) {
                if (this.cleanRole.indexOf(this.roles[id].id) == -1) {
                    this.user.roles.push({
                        'id': this.roles[id].id,
                        'name': this.roles[id].name
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
                Api.post('v1', 'saveUser', this.getUserData(this.user))
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        this.$parent.close();
                        this.$root.$emit('getUsers');
                    })
                    .catch(error => {
                        this.$toast.open({
                            duration: 5000,
                            message: Api.errorSerializer(error.response.data.errors),
                            type: 'is-danger'
                        });
                    })
            },

            /**
             * get user data
             * @param user
             * @return {string}
             */
            getUserData(user) {

                return {
                    id: user.id || 0,
                    name: user.name || '',
                    email: user.email || '',
                    up_price: user.up_price || 0,
                    note: _.unescape(user.note) || '',
                    role: this.cleanRole || '',
                    confirm: parseInt(user.confirm),
                    password: user.password || ''
                };
            },

            /**
             * get clean role
             * @param role
             */
            getCleanRole() {
                let _vm = this;
                this.cleanRole = [];
                _.forEach(this.user.roles, function (value) {
                    _vm.cleanRole.push(value.id);
                });
            }
        },


    }
</script>