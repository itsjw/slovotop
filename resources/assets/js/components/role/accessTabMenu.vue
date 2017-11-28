<template>
    <section class="ui-mt-2">

        <b-table
                :data="menus"
                :hoverable=true
                :loading='tableLoading'
                :narrowed=true
                :paginated=false>

            <template slot-scope="props">
                <b-table-column field="name" :label="trans('data.titleMenu')" sortable>
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column :label="trans('data.read')" centered>
                    <div class="field">
                        <b-checkbox></b-checkbox>
                    </div>
                </b-table-column>

                <b-table-column :label="trans('data.write')" centered>
                    <div class="field">
                        <b-checkbox></b-checkbox>
                    </div>
                </b-table-column>
            </template>

            <template slot="empty">
                <section class="section">
                    <div class="content has-text-grey has-text-centered">
                        <p>
                            <b-icon
                                    icon="ban"
                                    icon-pack="fa"
                                    size="is-large">
                            </b-icon>
                        </p>
                        <p>{{ trans('data.searchNull') }}</p>
                    </div>
                </section>
            </template>
        </b-table>

    </section>
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
                menus: [],
                // table
                tableLoading: false
            }
        },

        methods: {
            /**
             * get menus
             */
            getMenus() {
                this.tableLoading = true;
                Api.post('v1', 'getMenus')
                    .then(response => {
                        this.menus = response.data.data;
                        this.tableLoading = false;
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