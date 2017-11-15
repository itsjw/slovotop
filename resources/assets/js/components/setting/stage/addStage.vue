<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w25 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.stageName') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="text"
                           v-model="stage.name">
                </div>
                <div class="ui-mb-2" v-if="isAdmin">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.stagePriority') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="number"
                           v-model="stage.priority">
                </div>

                <div class="ui-mt-5">
                    <button type="button"
                            class="ui-button bg-green hover ui-color col-wite ui-fnt regular size-1"
                            @click="saveSubject()">
                        {{ trans('data.save') }}
                    </button>
                    <button type="button"
                            class="ui-button bg-grey hover ui-color col-wite ui-fnt regular size-1"
                            @click="$emit('close')">
                        {{ trans('data.cancel') }}
                    </button>
                </div>

            </div>
        </div>

    </div>
</template>
<script>
    export default {

        mounted() {
        },

        props: {
            stage_id: {
                default: 0
            }
        },

        data() {
            return {
                stage: {}
            }
        },

        methods: {

        }
    }
</script>