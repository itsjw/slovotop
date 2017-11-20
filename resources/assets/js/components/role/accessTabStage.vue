<template>
    <div class="ui-grid-block ui-mt-5">

        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="5%">№</th>
                <th width="85%" class="left">{{ trans('data.stageName') }}</th>
                <th width="10%">{{ trans('data.access') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in stages">
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td>
                    <input type="checkbox"
                           :id="'menuR'+key"
                           v-model="val.priority"
                           :true-value="1"
                           :false-value="0"
                           @change="selectStage(key)"/>
                    <label :for="'menuR'+key" class="ui-checkbox ui-color col-green"></label>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>
<script>
    export default {

        mounted() {
            this.getStages();
        },

        props: {},

        data() {
            return {
                stages: {}
            }
        },

        methods: {
            /**
             * select stage and save
             * @param id
             */
            selectStage(id) {

            },

            /**
             * get all stages
             */
            getStages() {
                gql.getItem('v2', 'TaskStageQuery', false, 'stage')
                    .then(response => {
                        this.stages = response.data.data.TaskStageQuery;
                    })
            }
        }
    }
</script>