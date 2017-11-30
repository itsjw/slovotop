<template>
    <div class="ui-p-3 bg bg-wite">
        <div class="columns">
            <div class="column is-4">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Component
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="level">
                            <div class="level-left">
                                <p>{{ trans('data.setEditor') }}</p>
                            </div>
                            <div class="level-right">
                                <b-field>
                                    <b-select
                                            placeholder="Client"
                                            icon="user"
                                            icon-pack="fa">
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
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
                                            placeholder="Client"
                                            icon="user"
                                            icon-pack="fa">
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
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
        },

        props: {},

        data() {
            return {
                roles: []
            }
        },

        methods: {}
    }
</script>