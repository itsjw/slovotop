<template>
    <section>
        <nav class="navbar is-primary" v-if="accessMenu == 2">
            <div class="navbar-start">
                <a class="navbar-item">
                    <b-icon
                            icon="reload"
                            size="is-small">
                    </b-icon>
                </a>

                <a class="navbar-item" @click="addTask()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-plus-circle"></i>
                    </span>
                    <span>{{ trans('data.save') }}</span>
                </a>

                <a class="navbar-item" @click="editTask()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-pencil"></i>
                    </span>
                    <span>{{ trans('data.taskNext') }}</span>
                </a>

                <a class="navbar-item" @click="confirmDeleteTask()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-delete"></i>
                    </span>
                    <span>{{ trans('data.taskGet') }}</span>
                </a>

                <a class="navbar-item" @click="confirmDeleteTask()">
                    <span class="icon is-medium">
                        <i class="mdi mdi-18px mdi-delete"></i>
                    </span>
                    <span>{{ trans('data.taskReturn') }}</span>
                </a>
            </div>
        </nav>
    </section>
</template>

<style scoped>

</style>

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