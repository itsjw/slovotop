<template>
    <div>

        <div class="ui-grid-block ui-mb-3">
            <div class="ui-grid-6">
                <button type="button" class="ui-button bg-blue hover ui-color col-wite">
                    {{ trans('data.save') }}
                </button>
                <button type="button" class="ui-button bg-green hover ui-color col-wite">
                    {{ trans('data.taskGet') }}
                </button>
                <button type="button" class="ui-button bg-orange hover ui-color col-wite">
                    {{ trans('data.taskReturn') }}
                </button>
            </div>
            <div class="ui-grid-6"></div>
        </div>

        <div class="ui-grid-block top">
            <div class="ui-grid-8">

                <div class="ui-bg bg-wite ui-p-3 ui-shadow-hover">
                    <div class="ui-grid-block">
                        <div class="ui-grid-6 ui-pr-1">
                            <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                                {{ trans('data.taskName') }}
                            </div>
                            <input class="ui-input green focus ui-fnt light size-1" type="text" v-model="task.name">
                        </div>
                        <div class="ui-grid-6 ui-pl-1">
                            <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                                {{ trans('data.taskTitle') }}
                            </div>
                            <input class="ui-input green focus ui-fnt light size-1" type="text" v-model="task.title">
                        </div>
                    </div>
                    <div class="ui-grid-12">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                            {{ trans('data.taskDesc') }}
                        </div>
                        <textarea class="ui-input green focus ui-fnt light size-1" type="text"
                                  v-model="task.desc"></textarea>
                    </div>
                </div>

                <div class="ui-bg bg-wite ui-p-3 ui-mt-3 ui-shadow-hover">
                    <div class="ui-grid-block">
                        <div class="ui-grid-6 ui-pr-1">
                            <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                                {{ trans('data.taskWords') }}
                            </div>
                            <textarea class="ui-input green focus ui-fnt light size-1" type="text"
                                      v-model="task.words"></textarea>
                        </div>
                        <div class="ui-grid-6 ui-pl-1">
                            <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                                {{ trans('data.taskMoreData') }}
                            </div>
                            <textarea class="ui-input green focus ui-fnt light size-1" type="text"
                                      v-model="task.more_data"></textarea>
                        </div>
                    </div>
                </div>

                <div class="ui-bg bg-wite ui-p-3 ui-mt-3 ui-shadow-hover">
                    <div class="ui-grid-12 ui-pl-1">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                            {{ trans('data.taskTask') }}
                        </div>
                        <textarea class="ui-input green focus ui-fnt light size-1" type="text"
                                  v-model="task.task"></textarea>
                    </div>
                </div>

                <div class="ui-bg bg-wite ui-p-3 ui-mt-3 ui-shadow-hover">
                    <div class="ui-grid-12 ui-pl-1">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                            {{ trans('data.taskRuleText') }}
                        </div>
                        <textarea class="ui-input green focus ui-fnt light size-1" type="text"
                                  v-model="task.rule_text"></textarea>
                    </div>
                </div>

                <div class="ui-bg bg-wite ui-p-3 ui-mt-3 ui-shadow-hover">
                    <div class="ui-grid-12">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                            {{ trans('data.taskTextBody') }}
                        </div>
                        <div id="editor"></div>
                    </div>
                </div>

                <div class="ui-bg bg-wite ui-p-3 ui-mt-3 ui-shadow-hover">
                    <div class="ui-grid-12">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                            {{ trans('data.taskTextPreview') }}
                        </div>
                        <textarea class="ui-input green focus ui-fnt light size-1" type="text"
                                  v-model="task.text_preview"></textarea>
                    </div>
                </div>

                <div class="ui-bg bg-wite ui-p-3 ui-mt-3 ui-shadow-hover">
                    <div class="ui-grid-12">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                            {{ trans('data.taskTextUrl') }}
                        </div>
                        <input class="ui-input green focus ui-fnt light size-1" type="url" v-model="task.text_url">
                    </div>
                </div>

                <div class="ui-bg bg-wite ui-p-3 ui-mt-3 ui-shadow-hover">
                    <div class="ui-grid-12">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1 ui-mt-1">
                            {{ trans('data.commentsTitle') }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="ui-grid-4">
                <div class="ui-grid-block ui-shadow-hover ui-ml-3 ui-bg bg-wite ui-p-3">

                    <div class="ui-grid-12">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                            {{ trans('data.taskProject') }}
                        </div>
                        <select class="ui-input green focus ui-fnt light size-1" v-model="task.project.id">
                            <option v-for="(val,key) in projects" :value="val.id">
                                {{ val.name }}
                            </option>
                        </select>
                    </div>

                    <div class="ui-grid-12 ui-mt-2">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                            {{ trans('data.taskEditor') }}
                        </div>
                        <select class="ui-input green focus ui-fnt light size-1" v-model="task.editor.id">
                            <option v-for="(val,key) in editors" :value="val.id">
                                {{ val.name }}
                            </option>
                        </select>
                    </div>

                    <div class="ui-grid-12 ui-mt-2">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                            {{ trans('data.taskAuthor') }}
                        </div>
                        <select class="ui-input green focus ui-fnt light size-1" v-model="task.author.id">
                            <option v-for="(val,key) in authors" :value="val.id">
                                {{ val.name }}
                            </option>
                        </select>
                    </div>

                    <div class="ui-grid-12 ui-mt-2">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                            {{ trans('data.taskSubject') }}
                        </div>
                        <select class="ui-input green focus ui-fnt light size-1" v-model="task.subject.id">
                            <option v-for="(val,key) in subjects" :value="val.id">
                                {{ val.name }}
                            </option>
                        </select>
                    </div>

                    <div class="ui-grid-12 ui-mt-2">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                            {{ trans('data.taskTextMinMax') }}
                        </div>
                        <div class="ui-grid-block">
                            <div class="ui-grid-6 ui-pr-3">
                                <input class="ui-input green focus ui-fnt light size-1" type="number"
                                       v-model="task.text_min">
                            </div>
                            <div class="ui-grid-6 ui-pl-3">
                                <input class="ui-input green focus ui-fnt light size-1" type="number"
                                       v-model="task.text_max">
                            </div>
                        </div>
                    </div>

                    <div class="ui-grid-12 ui-mt-2">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                            {{ trans('data.taskTextUnique') }}
                        </div>
                        <input class="ui-input green focus ui-fnt light size-1" type="number"
                               v-model="task.text_unique">
                    </div>

                    <div class="ui-grid-12 ui-mt-2">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                            {{ trans('data.taskPrice') }}
                        </div>
                        <input class="ui-input green focus ui-fnt light size-1" type="number"
                               v-model="task.price">
                    </div>

                    <div class="ui-grid-12 ui-mt-2">
                        <div class="ui-fnt regular size-2 ui-color col-grey ui-mb-1">
                            {{ trans('data.taskDateEnd') }}
                        </div>
                        <input class="ui-input green focus ui-fnt light size-1" type="date"
                               v-model="task.date_end">
                    </div>

                </div>
            </div>
        </div>

        <div class="ui-grid-block ui-mt-3">
            <div class="ui-grid-6">
                <button type="button" class="ui-button bg-blue hover ui-color col-wite">
                    {{ trans('data.save') }}
                </button>
                <button type="button" class="ui-button bg-green hover ui-color col-wite">
                    {{ trans('data.taskGet') }}
                </button>
                <button type="button" class="ui-button bg-orange hover ui-color col-wite">
                    {{ trans('data.taskReturn') }}
                </button>
            </div>
            <div class="ui-grid-6"></div>
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

            if (this.task_id > 0) {
                this.getTask();
            }

            this.getProject();
            this.getUser('editors');
            this.getUser('authors');
            this.getSubject();
        },

        props: {
            user_id: {},
            task_id: {}
        },

        data() {
            return {
                task: {
                    project: {},
                    editor: {},
                    author: {},
                    subject: {}
                },
                projects: {},
                editors: {},
                authors: {},
                subjects: {}
            }
        },

        methods: {

            /**
             * get users
             * @param role
             */
            getUser(role) {
                gql.getItem('v2', 'UserQuery', false, 'user')
                    .then(response => {
                        this[role] = response.data.data.UserQuery;
                    })
            },

            /**
             * get projects
             */
            getProject() {
                gql.getItem('v2', 'ProjectQuery', this.queryParams, 'project')
                    .then(response => {
                        this.projects = response.data.data.ProjectQuery;
                    })
            },

            /**
             * get subjects
             */
            getSubject() {
                gql.getItem('v2', 'TaskSubjectQuery', false, 'subject')
                    .then(response => {
                        this.subjects = response.data.data.TaskSubjectQuery;
                    })
            },

            getTask() {

            }
        }
    }
</script>