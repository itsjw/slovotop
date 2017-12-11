<template>
    <div>

        <div class="content" v-if="accessMenu != 2">
            <h1>{{ doc.name }}</h1>
            <p v-html="converToHtml(doc.body)"></p>
        </div>

        <div class="columns" v-if="accessMenu == 2">
            <div class="column is-10 bg bg-wite">

                <form>
                    <b-field :label="trans('data.docsName')">
                        <b-input type="text" v-model="doc.name"></b-input>
                    </b-field>

                    <section>

                        <div class="columns ui-mt-2">
                            <div class="column is-1">
                                <b-dropdown>
                                    <button type="button" class="button is-link" slot="trigger">
                                        <span>{{ trans('data.userRole') }}</span>
                                        <b-icon icon="menu-down"></b-icon>
                                    </button>

                                    <b-dropdown-item v-for="(val,id) in roles" :key=val.id @click="addRole(id)">
                                        {{ val.name }}
                                    </b-dropdown-item>
                                </b-dropdown>
                            </div>
                            <div class="column">
                                <div class="field is-grouped is-grouped-multiline">
                                    <div class="control" v-for="(item,k) in doc.roles">
                                        <div class="tags has-addons">
                                            <a class="tag is-warning">{{ item.name }}</a>
                                            <a class="tag is-delete" @click="deleteRole(k)"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>

                    <b-field :label="trans('data.docsBody')" class="ui-mt-3">
                        <textarea id="editor"></textarea>
                    </b-field>

                    <footer class="modal-card-foot">
                        <button class="button" type="button" @click="cancelDoc()">{{ trans('data.cancel') }}
                        </button>
                        <button class="button is-primary" type="button" @click.prevent="saveDoc()"
                                :disabled="isDisabled">
                            <b-icon
                                    :icon="isDisabled ? 'reload' : 'check'"
                                    :custom-class="isDisabled ? 'mdi-spin' : ''">
                            </b-icon>
                            <span>{{ trans('data.save') }}</span>
                        </button>
                    </footer>

                </form>

            </div>
            <div class="column is-2"></div>

        </div>
    </div>
</template>
<script>
    export default {

        mounted() {
            this.getRoles();

            if (this.accessMenu == 2) {
                this.editor = new Jodit(document.getElementById('editor'), {
                    height: 400,
                    buttons: ['source', '|', 'bold', 'italic', '|', 'ul', 'ol', '|', 'font', 'fontsize', 'brush',
                        'paragraph', '|', 'image', 'video', 'table', 'link', '|', 'align', '|', 'undo', 'redo', '|',
                        'hr', 'eraser', 'fullsize', 'copyformat']
                });
            }

            if (this.doc_id > 0) {
                this.getDoc();
            }
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
                cleanRole: [],
                roles: [],
                editor: {},
                doc: {
                    roles: []
                },
                // save button
                isDisabled: false
            }
        },

        methods: {

            /**
             * unescape text
             * @param text
             */
            converToHtml(text) {
                return _.unescape(text);
            },

            /**
             * get roles
             */
            getRoles() {
                Api.post('v1', 'getRoles',)
                    .then(response => {
                        this.roles = response.data.data;
                    })
            },

            /**
             * add role
             * @param id
             */
            addRole(id) {
                this.showRoles = false;
                if (this.cleanRole.indexOf(this.roles[id].id) == -1) {
                    this.doc.roles.push({
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

                _.forEach(this.doc.roles, function (value) {
                    _vm.cleanRole.push(value.id);
                });

            },

            /**
             * delete role
             * @param id
             */
            deleteRole(id) {
                this.doc.roles.splice(id, 1);
                this.getCleanRole();
            },

            /**
             * get doc for edit
             */
            getDoc() {
                Api.post('v1', 'getDocs', {id: this.doc_id})
                    .then(response => {
                        this.doc = response.data.data[0];
                        this.editor.setEditorValue(_.unescape(response.data.data[0].body));
                        this.getCleanRole();
                    })
            },

            /**
             * save doc
             */
            saveDoc() {
                this.isDisabled = true;
                Api.post('v1', 'saveDoc', this.getDocData(this.doc))
                    .then(response => {
                        this.$toast.open({
                            message: response.data.success,
                            type: 'is-success'
                        });
                        history.pushState(null, null, response.data.id);
                        this.doc.id = response.data.id;
                        this.isDisabled = false;
                    })
                    .catch(error => {
                        this.$toast.open({
                            duration: 5000,
                            message: Api.errorSerializer(error.response.data.errors),
                            type: 'is-danger'
                        });
                        this.isDisabled = false;
                    });
            },

            /**
             * get doc data
             */
            getDocData(doc) {
                doc.body = this.editor.getEditorValue().replace(/\r\n|\r|\n/g, '<br>');

                return {
                    id: doc.id || 0,
                    name: _.escape(doc.name) || '',
                    roles: this.cleanRole || '',
                    user: this.user_id,
                    body: _.escape(doc.body) || ''
                };
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