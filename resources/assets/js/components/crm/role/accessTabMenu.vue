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
                       :id="'menu'+key"/>
                       <!-- v-model="val.accessMenu.access"
                       v-bind:true-value="1"
                       v-bind:false-value="0"
                       @change="selectMenu(key)" !-->
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
                gql.getItem('v1', 'MenuQuery', 'role_id:' + this.role, 'menu')
                    .then(response => {
                        this.menus = response.data.data.MenuQuery;
                    })
            },

            /**
             * select access menu
             * @param key
             */
            selectMenu(key) {
                gql.setItem('v1', 'AccessMenuMutation', this.getData(this.menus[key]))
                    .then(response => {
                        this.getMenus();
                    });
            },

            getData(menu) {
                return `
                    id: ${menu.accessMenu.id},
                    access: ${menu.accessMenu.access},
                    menu: ${menu.id},
                    role: ${this.role}`;
            }
        }
    }
</script>