<template>
    <section>

        <b-tabs @change="change">
            <b-tab-item :label="trans('data.reportStep')"
                        icon="debug-step-over">
            </b-tab-item>
        </b-tabs>

    </section>
</template>

<script>
    export default {

        name: "report",

        mounted() {
        },

        props: {},

        data() {
            return {
                tabActive: 0
            }
        },

        methods: {
            /**
             * show active tab
             * @param index
             */
            change(index) {
                this.tabActive = index;
            }
        }
    }
</script>