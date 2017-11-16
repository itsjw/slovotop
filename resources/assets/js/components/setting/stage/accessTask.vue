<template>
    <div>

        <div class="ui-popup-bg" @click="$emit('close')"></div>
        <div class="ui-popup top w50 left animated fadeIn ui-bg bg-wite">
            <div class="ui-popup-close col-red hover ui-icon" @click="$emit('close')">close</div>
            <div class="ui-p-3">

                <table>
                    <thead>
                    <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                        <th width="5%">№</th>
                        <th width="65%" class="left">{{ trans('data.taskField') }}</th>
                        <th width="10%">{{ trans('data.read') }}</th>
                        <th width="10%">{{ trans('data.write') }}</th>
                        <th width="10%">{{ trans('data.hide') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="ui-fnt light size-1 ui-color col-black"
                        v-for="(val,key) in stageAccess">
                        <td>{{ key + 1 }}</td>
                        <td class="left">{{ val.name }}</td>
                        <td>
                            <input type="checkbox"
                                   :id="'menuR'+key"
                                   v-model="val.access"
                                   :true-value="1"
                                   :false-value="0"
                                   @change="selectMenu(key)"/>
                            <label :for="'menuR'+key" class="ui-checkbox ui-color col-green"></label>
                        </td>
                        <td>
                            <input type="checkbox"
                                   :id="'menuW'+key"
                                   v-model="val.access"
                                   :true-value="2"
                                   :false-value="0"
                                   @change="selectMenu(key)"/>
                            <label :for="'menuW'+key" class="ui-checkbox ui-color col-green"></label>
                        </td>
                        <td>
                            <input type="checkbox"
                                   :id="'menuW'+key"
                                   v-model="val.access"
                                   :true-value="0"
                                   :false-value="0"
                                   @change="selectMenu(key)"/>
                            <label :for="'menuW'+key" class="ui-checkbox ui-color col-green"></label>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</template>
<script>
    export default {

        mounted() {
            this.getStageAccess();
        },

        props: {
            stage_id: {}
        },

        data() {
            return {
                stageAccess: {}
            }
        },

        methods: {
            getStageAccess() {
                gql.getRaw('/api/stageAccess', {stage: 1})
                    .then(response => {
                        this.stageAccess = response.data;
                        console.log(response.data);
                    })
            }
        }
    }
</script>