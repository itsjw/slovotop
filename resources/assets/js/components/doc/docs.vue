<template>
    <div>

        <div class="ui-navbar ui-mb-5" v-if="accessMenu == 2">
            <ul>
                <li @click="addDoc()">
                    <i class="ui-icon ui-mr-2">note_add</i>
                    <span>{{ trans('data.add') }}</span>
                </li>
                <li @click="editDoc()">
                    <i class="ui-icon ui-mr-2">edit</i>
                    <span>{{ trans('data.edit') }}</span>
                </li>
                <li @click="deleteDoc()">
                    <i class="ui-icon ui-mr-2">delete</i>
                    <span>{{ trans('data.delete') }}</span>
                </li>
            </ul>
        </div>

        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="1%">
                    <i class="ui-icon size-3 ui-color col-green hover"
                       @click="getDocs()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="60%" class="left">
                    <div class="ui-grid-block">
                        <search-pop
                            v-if="showSearchName"
                            position="left"
                            type="searchName"
                            @submit="search"
                            @close="closePopUp()"></search-pop>

                        <i class="ui-icon ui-color col-orange hover ui-fnt size-3 ui-mr-1"
                           @click="showSearchName=true">search</i>
                        <i class="ui-icon ui-color col-red hover ui-fnt size-3 ui-mr-1"
                           v-show="queryParams[0]"
                           @click="search()">close</i>

                        <span>{{ trans('data.docsName') }}</span>
                    </div>
                </th>
                <th width="10%">{{ trans('data.docsOwner') }}</th>
                <th width="10%">{{ trans('data.created_at') }}</th>
                <th width="10%">{{ trans('data.updated_at') }}</th>
                <th width="5%">ID</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in docs"
                @click="selectDocs(val.id)">
                <td>
                    <div v-if="accessMenu > 1">
                        <input type="checkbox" :id="key" :value="val.id" v-model="selectDoc"/>
                        <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                    </div>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td>{{ val.user.name }}</td>
                <td>{{ val.created_at }}</td>
                <td>{{ val.updated_at }}</td>
                <td>{{ val.id }}</td>
            </tr>
            </tbody>
        </table>

    </div>
</template>
<script>
    export default {

        mounted() {
            this.getDocs();
            console.log(this.currentUser);
        },

        props: {},

        data() {
            return {
                queryParams: [],
                showSearchName: false,
                docs: {},
                selectDoc: [],
            }
        },

        methods: {

            /**
             * close all popup
             */
            closePopUp() {
                this.showSearchName = false;
                this.getDocs();
            },

            /**
             * select docs
             */
            selectDocs(id) {
                if (this.accessMenu == 2) {
                    if (this.selectDoc.indexOf(id) == -1) {
                        this.selectDoc.push(id);
                    } else {
                        this.selectDoc.splice(this.selectDoc.indexOf(id), 1);
                    }
                } else {
                    window.location = 'docs/doc/' + id;
                }
            },

            /**
             * search my type and value
             * @param value
             * @param type
             */
            search(value, type) {
                this.queryParams.splice(0, 1);

                if (value) {
                    this.queryParams.splice(0, 1, '' + type + ':"' + value + '"');
                }
                this.closePopUp();
            },

            /**
             * get docs
             */
            getDocs() {
                this.selectDoc = [];
                gql.getItem('v2', 'DocQuery', this.queryParams.length > 0 ? this.queryParams : false, 'doc')
                    .then(response => {
                        this.docs = response.data.data.DocQuery;
                    })
            },

            /**
             * add doc
             */
            addDoc() {
                window.location = 'docs/doc/';
            },

            /**
             * edit doc
             */
            editDoc() {
                if (this.selectDoc.length > 0) {
                    window.location = 'docs/doc/' + this.selectDoc[0];
                }
            },

            /**
             * delete doc
             */
            deleteDoc() {
                let select;
                if (this.selectDoc.length > 0) {
                    if (confirm('Удалить?')) {
                        select = ['items:"' + this.selectDoc + '"'];
                    }
                    gql.setItem('v2', 'DeleteDocMutation', select)
                        .then(response => {
                            notify.make('success', response.data.data.DeleteDocMutation.notify, 1);
                            this.getDocs();
                        })
                }
            }
        }
    }
</script>