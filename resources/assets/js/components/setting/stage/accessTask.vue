<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w25 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">

                Hello

            </div>
        </div>

    </div>
</template>
<script>
    export default {

        created() {
        },

        mounted() {
        },

        props: {
            stage_id: {}
        },

        data() {
            return {}
        },

        methods: {}
    }
</script>