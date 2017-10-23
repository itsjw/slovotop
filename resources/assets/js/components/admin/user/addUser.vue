<template>
    <div>
        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup animated fadeIn ui-bg bg-wite w20">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userName') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1" type="text">
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userSurname') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1" type="text">
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userEmail') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1" type="email">
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userPassword') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1" type="password">
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userConfirm') }}
                    </div>
                    <input type="checkbox" id="conf"/>
                    <label for="conf" class="ui-checkbox ui-color col-green hover"></label>
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userRole') }}
                    </div>
                </div>
                <div class="ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.userRole') }}
                    </div>
                    <select class="ui-input green focus">
                        <option></option>
                        <option>dasdasdas</option>
                        <option>dasdasdas</option>
                    </select>
                </div>
                <div class="ui-mt-5">
                    <button type="button" class="ui-button bg-blue hover ui-color col-wite ui-fnt regular size-2">
                        {{ trans('data.save') }}
                    </button>
                    <button type="button" class="ui-button bg-grey hover ui-color col-wite ui-fnt regular size-2">
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

        props: [],

        data() {
            return {}
        },

        methods: {}
    }
</script>