<template>
    <div class="ui-grid-block ui-mt-5 ui-p-3 ui-bg bg-greyLL">

        <div class="ui-grid-block"
             v-for="(val,key) in menus">
            <div class="ui-grid-10">
                <div class="ui-fnt regular size-2 ui-color col-green">
                    {{ val.name }}
                </div>
            </div>
            <div class="ui-grid-2 center">
                <input type="checkbox"
                       :id="'menu'+key"
                       v-model="val.roles[0].access"
                       v-bind:true-value="1"
                       v-bind:false-value="0"
                       @change="selectMenu(key)"/>
                <label :for="'menu'+key" class="ui-checkbox ui-color col-green"></label>
            </div>
        </div>

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
                        notify.make('success', response.data.data.ChangeAccessMenuMutation.notify,1);
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