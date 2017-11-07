<template>
    <div>

        <div class="ui-grid-block">
            <div class="ui-grid-10">

                <div class="ui-grid-12 ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.docsName') }}
                    </div>
                    <input class="ui-input green focus ui-fnt light size-1"
                           type="text"
                           v-model="doc.name">
                </div>

                <div class="ui-grid-12 ui-mb-2">
                    <div class="ui-block-flex">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-block-flex">
                            <span class="ui-pr-2">{{ trans('data.userRole') }}</span>
                            <i class="ui-icon size-5 ui-color col-green hover"
                               @click="getRoles()">add_circle</i>

                            <div class="ui-popup-bg" @click="showRoles=false" v-if="showRoles"></div>
                            <div class="ui-popup ui-bg bg-wite" v-if="showRoles">
                                <table>
                                    <tbody>
                                    <tr v-for="(val,key) in roles"
                                        class="hover ui-fnt regular size-1 ui-color col-blue">
                                        <td class="left" @click="addRole(key)">{{ val.name }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div v-for="(item,k) in arrayRoles"
                             class="ui-tag bg-yellow hover ui-fnt regular size-1 ui-color col-greyBlue ui-block-flex ui-m-1 animated fadeIn">
                            {{ item.name }}
                            <i class="ui-icon size-2 ui-ml-2 ui-color col-red hover"
                               @click="deleteRole(k)">close</i>
                        </div>
                    </div>
                </div>

                <div class="ui-grid-12 ui-mb-2">
                    <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                        {{ trans('data.docsBody') }}
                    </div>
                    <textarea class="ui-input" id="editor"></textarea>
                </div>

                <div class="ui-grid-12 ui-mb-2 ui-mt-3">
                    <button type="button"
                            class="ui-button bg-green hover ui-color col-wite ui-fnt regular size-1"
                            @click="saveDoc()">
                        {{ trans('data.save') }}
                    </button>
                    <button type="button"
                            class="ui-button bg-grey hover ui-color col-wite ui-fnt regular size-1"
                            @click="cancelDoc()">
                        {{ trans('data.cancel') }}
                    </button>
                </div>

            </div>
            <div class="ui-grid-2"></div>
        </div>

    </div>
</template>
<script>
    export default {

        mounted() {
            this.editor = new Jodit(document.getElementById('editor'), {
                height: 400,
                buttons: ['source', '|', 'bold', 'italic', '|', 'ul', 'ol', '|', 'font', 'fontsize', 'brush',
                    'paragraph', '|', 'image', 'video', 'table', 'link', '|', 'align', '|', 'undo', 'redo', '|',
                    'hr', 'eraser', 'fullsize', 'copyformat']
            });
        },

        props: {
            doc_id: {
                default: 0
            },
            user_id: ''
        },

        data() {
            return {
                showRoles: false,
                arrayRoles: [],
                cleanRole: [],
                roles: [],
                editor: {},
                doc: {}
            }
        },

        methods: {
            /**
             * get roles
             */
            getRoles() {
                gql.getItem('v1', 'RoleQuery', null, 'role')
                    .then(response => {
                        this.roles = response.data.data.RoleQuery;
                        this.showRoles = true;
                    })
            },

            /**
             * add role
             * @param id
             */
            addRole(id) {
                this.showRoles = false;
                if (this.cleanRole.indexOf(this.roles[id].id) == -1) {
                    this.arrayRoles.push({
                        'id': this.roles[id].id,
                        'name': this.roles[id].name
                    });
                }
                this.getCleanRole();
            },

            /**
             * get clean role
             * @param role
             */
            getCleanRole() {
                let _vm = this;
                this.cleanRole = [];

                _.forEach(this.arrayRoles, function (value) {
                    _vm.cleanRole.push(value.id);
                });

            },

            /**
             * delete role
             * @param id
             */
            deleteRole(id) {
                this.arrayRoles.splice(id, 1);
                this.getCleanRole();
            },

            /**
             * save doc
             */
            saveDoc() {
                gql.setItem('v1', 'AddDocMutation', this.getDocData(this.doc))
                    .then(response => {
                        if (response.data.errors) {
                            notify.make('alert', response.data.errors[0].validation);
                        } else {
                            notify.make('success', response.data.data.AddDocMutation.id, 2);
                        }
                    });
            },

            /**
             * get doc data
             */
            getDocData(doc) {
                doc.body = this.editor.getEditorValue().replace(/\r\n|\r|\n/g, '<br>');

                return `
                        id: ${this.doc_id == 0 ? this.doc_id : doc.id},
                        name: "${_.escape(doc.name) || ''}",
                        roles: "${this.cleanRole || ''}",
                        user: ${this.user_id},
                        body: "${_.escape(doc.body) || ''}"`;
            },

            /**
             * cancel save doc
             */
            cancelDoc() {
                window.location = '/crm/docs';
            }
        }
    }
</script>