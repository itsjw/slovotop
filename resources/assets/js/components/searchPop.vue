<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup-tip ui-bg bg-wite animated fadeIn" :class="this.position">

            <input type="text" class="ui-input cyan" autofocus
                   @keyup.enter="submit()"
                   @keyup.esc="$emit('close')"/>

        </div>

    </div>
</template>
<script>
    export default {

        mounted() {
        },

        props: {
            type: {},
            position: {
                default: 'left'
            }
        },

        data() {
            return {}
        },

        methods: {}
    }
</script>