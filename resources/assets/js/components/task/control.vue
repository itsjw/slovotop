<template>
    <div class="field is-grouped">
        <button class="button is-primary control" type="button"
                :disabled="isRefresh"
                @click="$emit('close',0)">
            <b-icon
                    pack="fa"
                    :icon="isRefresh ? 'refresh' : 'check'"
                    :custom-class="isRefresh ? 'fa-spin' : ''">
            </b-icon>
            <span>{{ trans('data.save') }}</span>
        </button>
        <button class="button is-success control" type="button"
                :disabled="isRefresh"
                @click="$emit('close',1)">
            <b-icon
                    pack="fa"
                    icon="arrow-right">
            </b-icon>
            <span>{{ trans('data.taskNext') }}</span>
        </button>
        <button class="button is-link control" type="button"
                :disabled="isRefresh">
            <b-icon
                    pack="fa"
                    icon="arrow-right">
            </b-icon>
            <span>{{ trans('data.taskGet') }}</span>
        </button>
        <button class="button is-warning control" type="button"
                :disabled="isRefresh"
                @click="$emit('close',1)">
            <b-icon
                    pack="fa"
                    icon="arrow-left">
            </b-icon>
            <span>{{ trans('data.taskReturn') }}</span>
        </button>
    </div>

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