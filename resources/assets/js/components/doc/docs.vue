<template>
    <div>

        <div class="ui-grid-block ui-bg bg-blue ui-mb-3 ui-p-1">
            <div class="ui-grid-6 ui-grid-block">
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="addDoc()">
                    <i class="ui-icon size-4">note_add</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.add') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="editDoc()">
                    <i class="ui-icon size-4">edit</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.edit') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="deleteDoc()">
                    <i class="ui-icon">delete</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.delete') }}</span>
                </div>
            </div>
            <div class="ui-grid-6"></div>
        </div>

        <table>
            <thead>
            <tr class="ui-fnt regular size-1 ui-color col-greyBlue">
                <th width="1%">
                    <i class="ui-icon size-3 ui-color col-green hover"
                       @click="getDocs()">autorenew</i>
                </th>
                <th width="4%">№</th>
                <th width="60%" class="left">{{ trans('data.docsName') }}</th>
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
                    <input type="checkbox" :id="key" :value="val.id" v-model="selectDoc"/>
                    <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
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
        },

        props: {},

        data() {
            return {
                docs: {},
                selectDoc: []
            }
        },

        methods: {
            /**
             * select docs
             */
            selectDocs(id) {
                if (this.selectDoc.indexOf(id) == -1) {
                    this.selectDoc.push(id);
                } else {
                    this.selectDoc.splice(this.selectDoc.indexOf(id), 1);
                }
            },

            /**
             * get docs
             */
            getDocs() {
                this.selectRole = [];
                gql.getItem('v1', 'DocQuery', false, 'doc')
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
                    gql.setItem('v1', 'DeleteDocMutation', select)
                        .then(response => {
                            notify.make('success', response.data.data.DeleteDocMutation.id,1);
                            this.getDocs();
                        })
                }
            }
        }
    }
</script>