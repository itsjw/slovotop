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
                        <td class="left">{{ val.lang }}</td>
                        <td>
                            <input type="checkbox"
                                   :id="'menuR'+key"
                                   v-model="val.access"
                                   :true-value="1"
                                   :false-value="0"
                                   @change="selectField(key)"/>
                            <label :for="'menuR'+key" class="ui-checkbox ui-color col-green"></label>
                        </td>
                        <td>
                            <input type="checkbox"
                                   :id="'menuW'+key"
                                   v-model="val.access"
                                   :true-value="2"
                                   :false-value="0"
                                   @change="selectField(key)"/>
                            <label :for="'menuW'+key" class="ui-checkbox ui-color col-green"></label>
                        </td>
                        <td>
                            <input type="checkbox"
                                   :id="'menuW'+key"
                                   v-model="val.access"
                                   :true-value="0"
                                   :false-value="0"
                                   @change="selectField(key)"/>
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
            /**
             * set access for field
             * @param key
             */
            selectField(key) {
                gql.setItem('v2', 'ChangeAccessTaskFieldMutation', this.getData(this.stageAccess[key]))
                    .then(response => {
                        notify.make('success', response.data.data.ChangeAccessTaskFieldMutation.notify, 1);
                    });
            },

            /**
             * get task fields
             */
            getStageAccess() {
                gql.getRaw('getStageAccess', {stage: this.stage_id})
                    .then(response => {
                        this.stageAccess = response.data;
                    })
            },

            /**
             * get data for change access
             * @param menu
             * @return {string}
             */
            getData(stage) {
                return `
                    access: ${stage.access},
                    stage: ${this.stage_id},
                    field: "${stage.name}"`;
            }
        }
    }
</script>