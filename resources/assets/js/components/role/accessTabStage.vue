<template>
    <div class="ui-grid-block ui-mt-5">

        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="5%">№</th>
                <th width="85%" class="left">{{ trans('data.titleMenu') }}</th>
                <th width="10%">{{ trans('data.read') }}</th>
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
                           v-model="val.roles[0].access"
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

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                stages: {}
            }
        },

        methods: {
            selectStage(id) {

            }
        }
    }
</script>