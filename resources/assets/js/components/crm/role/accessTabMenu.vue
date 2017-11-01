<template>
    <div>

        <div class="ui-mb-2 ui-grid-block"
             v-for="(val,key) in menus">
            <div class="ui-grid-10">
                <div class="ui-fnt regular size-2 ui-color col-green">
                    {{ val.name }}
                </div>
            </div>
            <div class="ui-grid-2">
                <input type="checkbox"
                       :id="'menu'+key"
                       v-model="selectMenu"
                       :value="val.id"/>
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
            role:{}
        },

        data() {
            return {
                menus: {},
                selectMenu: []
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
        }
    }
</script>