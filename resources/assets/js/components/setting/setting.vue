<template>
    <div>

        <div class="ui-navbar">
            <ul>
                <li>
                    <i class="ui-icon ui-mr-2">security</i>
                    <span>{{ trans('data.add') }}</span>
                </li>
                <li>
                    <i class="ui-icon ui-mr-2">edit</i>
                    <span>{{ trans('data.edit') }}</span>
                </li>
            </ul>
        </div>

    </div>
</template>
<script>
    export default {

        mounted() {
        },

        props: [],

        data() {
            return {}
        },

        methods: {}
    }
</script>