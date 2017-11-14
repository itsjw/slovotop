<template>
    <div>

        <div class="ui-grid-block ui-bg bg-blue ui-mb-3 ui-p-1" v-if="isAdmin">
            <div class="ui-grid-6 ui-grid-block">
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="addSubject()">
                    <i class="ui-icon size-4">subject</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.add') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="editSubject()">
                    <i class="ui-icon size-4">edit</i>
                    <span class="ui-pl-2 ui-fnt medium size-1">{{ trans('data.edit') }}</span>
                </div>
                <div class="ui-block-flex ui-pl-2 ui-pr-2 ui-color col-greyBlueLL hover"
                     @click="deleteSubject()">
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
                       @click="getSubjects()">autorenew</i>
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

                        <span>{{ trans('data.subjectName') }}</span>
                    </div>
                </th>
                <th width="10%">{{ trans('data.subjectPrice') }}</th>
                <th width="10%">{{ trans('data.created_at') }}</th>
                <th width="10%">{{ trans('data.updated_at') }}</th>
                <th width="5%">ID</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover ui-fnt light size-1 ui-color col-black"
                v-for="(val,key) in subjects"
                @click="selectSubjects(val.id)">
                <td>
                    <div v-if="accessMenu > 1">
                        <input type="checkbox" :id="key" :value="val.id" v-model="selectSubject"/>
                        <label :for="key" class="ui-checkbox ui-color col-green hover"></label>
                    </div>
                </td>
                <td>{{ key + 1 }}</td>
                <td class="left">{{ val.name }}</td>
                <td>{{ val.price }}</td>
                <td>{{ val.created_at }}</td>
                <td>{{ val.updated_at }}</td>
                <td>{{ val.id }}</td>
            </tr>
            </tbody>
        </table>

        <add-subject v-if="showAddSubject"
                     :subject_id="selectSubject[0]"
                     @close="closePopUp()"></add-subject>

    </div>
</template>
<script>
    Vue.component('addSubject', require('./addSubject.vue'));

    export default {

        mounted() {
            this.getSubjects();
        },

        props: {
            user_id: 0
        },

        data() {
            return {
                queryParams: [],
                showSearchName: false,
                showAddSubject: false,
                selectSubject: [],
                subjects: {}
            }
        },

        methods: {
            /**
             * close all popup
             */
            closePopUp() {
                this.showSearchName = false;
                this.showAddSubject = false;
                this.getSubjects();
            },

            /**
             * select subject
             */
            selectSubjects(id) {
                if (this.accessMenu == 2) {
                    if (this.selectSubject.indexOf(id) == -1) {
                        this.selectSubject.push(id);
                    } else {
                        this.selectSubject.splice(this.selectSubject.indexOf(id), 1);
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
             * get all subjects
             */
            getSubjects() {
                this.selectSubject = [];
                gql.getItem('v2', 'TaskSubjectQuery', this.queryParams.length > 0 ? this.queryParams : false, 'subject')
                    .then(response => {
                        this.subjects = response.data.data.TaskSubjectQuery;
                    })
            },

            /**
             * add subject
             */
            addSubject() {
                this.selectSubject = [];
                this.showAddSubject = true;
            },
            editSubject() {
            },
            deleteSubject() {
            }
        }
    }
</script>