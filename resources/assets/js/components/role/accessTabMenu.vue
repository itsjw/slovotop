<template>

    <div class="ui-grid-block ui-mt-5">
        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="5%">№</th>
                <th width="75%" class="left">{{ trans('data.titleMenu') }}</th>
                <th width="10%">{{ trans('data.read') }}</th>
                <th width="10%">{{ trans('data.write') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr class="ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in menus">
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td>
                    <input type="checkbox"
                           :id="'menuR'+key"
                           v-model="val.roles[0].access"
                           :true-value="1"
                           :false-value="0"
                           @change="selectMenu(key)"/>
                    <label :for="'menuR'+key" class="ui-checkbox ui-color col-green"></label>
                </td>
                <td>
                    <input type="checkbox"
                           :id="'menuW'+key"
                           v-model="val.roles[0].access"
                           :true-value="2"
                           :false-value="0"
                           @change="selectMenu(key)"/>
                    <label :for="'menuW'+key" class="ui-checkbox ui-color col-green"></label>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>
<script>
    export default {

        mounted() {
            this.getMenus();
        },

        props: {
            role: {}
        },

        data() {
            return {
                menus: {}
            }
        },

        methods: {
            /**
             * get menus
             */
            getMenus() {
                gql.getItem('v2', 'MenuQuery', 'role_id:' + this.role, 'menu')
                    .then(response => {
                        this.menus = response.data.data.MenuQuery;
                    })
            },

            /**
             * select access menu
             * @param key
             */
            selectMenu(key) {
                gql.setItem('v2', 'ChangeAccessMenuMutation', this.getData(this.menus[key]))
                    .then(response => {
                        notify.make('success', response.data.data.ChangeAccessMenuMutation.notify, 1);
                    });
            },

            /**
             * get data for change access
             * @param menu
             * @return {string}
             */
            getData(menu) {
                return `
                    access: ${menu.roles[0].access},
                    menu: ${menu.id},
                    role: ${this.role}`;
            }
        }
    }
</script>