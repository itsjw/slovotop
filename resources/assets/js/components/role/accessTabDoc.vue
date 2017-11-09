<template>
    <div>

        <div class="ui-grid-block ui-mt-5 ui-p-3 ui-bg bg-greyLL">

            <div class="ui-grid-block">
                <div class="ui-grid-10">
                    <div class="ui-fnt regular size-2 ui-color col-green">
                        {{ trans('data.roleDoc') }}
                    </div>
                </div>
                <div class="ui-grid-2 center">
                    <input type="checkbox" id="hello"/>
                    <label for="hello" class="ui-checkbox ui-color col-green"></label>
                </div>
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

        props: {},

        data() {
            return {}
        },

        methods: {}
    }
</script>