<template>
    <div class="ui-p-3 bg bg-wite">
        <div class="columns">
            <div class="column is-4">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            {{ trans('data.setGroupEdAth') }}
                        </p>
                        <a class="card-header-icon">
                          <span class="icon">
                            <i class="fa fa-refresh" :class="isRefresh ? 'fa-spin' : ''"
                               @click="getGenerals()"></i>
                          </span>
                        </a>
                    </header>
                    <div class="card-content">
                        <div class="level">
                            <div class="level-left">
                                <p>{{ trans('data.setEditor') }}</p>
                            </div>
                            <div class="level-right">
                                <b-field>
                                    <b-select
                                            :placeholder="trans('data.roleRoles')"
                                            icon="users"
                                            icon-pack="fa"
                                            v-model="generals.editor">
                                        <option
                                                v-for="(val,key) in roles"
                                                :value="val.id"
                                                :key="key">
                                            {{ val.name }}
                                        </option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>
                        <div class="level">
                            <div class="level-left">
                                <p>{{ trans('data.setAuthor') }}</p>
                            </div>
                            <div class="level-right">
                                <b-field>
                                    <b-select
                                            :placeholder="trans('data.roleRoles')"
                                            icon="users"
                                            icon-pack="fa"
                                            v-model="generals.author">
                                        <option
                                                v-for="(val,key) in roles"
                                                :value="val.id"
                                                :key="key">
                                            {{ val.name }}
                                        </option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-4">

            </div>
            <div class="column is-4">

            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: "general",

        mounted() {
            this.getRoles();
            this.getGenerals();
        },

        props: {},

        data() {
            return {
                isRefresh: false,
                generals: {
                    editor: null,
                    author: null,
                },
                roles: []

            }
        },

        methods: {

            /**
             * get all roles
             */
            getRoles() {
                Api.post('v1', 'getRoles')
                    .then(response => {
                        this.roles = response.data.data;
                    })
            },

            /**
            * get all general settings
            */
            getGenerals(){
                this.isRefresh = true;
                Api.post('v1', 'getGeneralSetting')
                    .then(response => {
                        this.generals = response.data.data;
                        this.isRefresh = false;
                    })
            }


        }
    }
</script>