<template>
    <section>
        <nav class="navbar is-light">
            <div class="navbar-start">
                <a class="navbar-item" @click="$emit('get')">
                    <b-icon icon="reload"></b-icon>
                </a>
                <div class="navbar-item">
                    <button type="button" class="button is-link" @click="$emit('save',2)">
                        <b-icon icon="approval"></b-icon>
                        <span>{{ trans('data.taskGet') }}</span>
                    </button>
                </div>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="field is-grouped">
                        <button type="button" class="button is-primary control" @click="$emit('save',3)">
                            <b-icon icon="check"></b-icon>
                            <span>{{ trans('data.save') }}</span>
                        </button>
                        <button type="button" class="button is-success control" @click="$emit('save',4)">
                            <b-icon icon="chevron-right"></b-icon>
                            <span>{{ trans('data.taskNext') }}</span>
                        </button>
                        <button type="button" class="button is-warning control" @click="$emit('save',5)">
                            <b-icon icon="backburger"></b-icon>
                            <span>{{ trans('data.taskReturn') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </section>
</template>

<script>
    export default {

        name: "control",

        mounted() {
        },

        props: {
            isRefresh: true
        },

        data() {
            return {}
        },

        methods: {}
    }
</script>