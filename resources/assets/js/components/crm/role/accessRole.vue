<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w25 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">

                <access-tab-menu :role="role_id"></access-tab-menu>

            </div>
        </div>

    </div>
</template>
<script>
    Vue.component('accessTabMenu', require('./accessTabMenu.vue'));

    export default {

        mounted() {
        },

        props: {
            role_id: {}
        },

        data() {
            return {}
        },

        methods: {}
    }
</script>