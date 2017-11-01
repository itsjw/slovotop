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
                       v-model="val.accessMenu.access"
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
                gql.getItem('v1', 'MenuQuery', false, 'menu')
                    .then(response => {
                        this.menus = response.data.data.MenuQuery;
                    })
            },

            /**
             * select access menu
             * @param key
             */
            selectMenu(key) {
                let id = this.menus[key].accessMenu.id,
                    access = this.menus[key].accessMenu.access;

                console.log(id, access);
            },

            // TODO
            getDatat() {
                return `
                    id: ${accessMenu.id},
                    access: ${}
                    menu: ${}
                    role: ${}
                `;
            }
        }
    }
</script>