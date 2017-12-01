<template>
    <section>
        <div class="field is-grouped">
            <button type="button" class="button is-primary control">{{ trans('data.save') }}</button>
            <button type="button" class="button is-link control">{{ trans('data.taskGet') }}</button>
            <button type="button" class="button is-warning control">{{ trans('data.taskReturn') }}</button>
        </div>

        <div class="columns">
            <div class="column is-9">
                <b-field :label="trans('data.taskName')"
                         v-if="task.name.access >= 1">
                    <b-input v-model="task.name.data"
                             :disabled="task.name.access == 1"></b-input>
                </b-field>

                <b-field :label="trans('data.taskTitle')"
                         v-if="task.title.access >= 1">
                    <b-input v-model="task.title.data"
                             :disabled="task.title.access == 1"></b-input>
                </b-field>

                <b-field :label="trans('data.taskDesc')"
                         v-if="task.desc.access >= 1">
                    <b-input type="textarea" minlength="10" maxlength="100"
                             v-model="task.desc.data"
                             :disabled="task.desc.access == 1"></b-input>
                </b-field>

                <div class="columns">
                    <div class="column is-6">
                        <b-field :label="trans('data.taskWords')"
                                 v-if="task.words.access >= 1">
                            <b-input type="textarea" minlength="10" maxlength="100"
                                     v-model="task.words.data"
                                     :disabled="task.words.access == 1"></b-input>
                        </b-field>
                    </div>
                    <div class="column is-6">
                        <b-field :label="trans('data.taskMoreData')"
                                 v-if="task.moreData.access >= 1">
                            <b-input type="textarea" minlength="10" maxlength="100"
                                     v-model="task.moreData.data"
                                     :disabled="task.moreData.access == 1"></b-input>
                        </b-field>
                    </div>
                </div>

                <b-field :label="trans('data.taskTask')"
                         v-if="task.task.access >= 1">
                    <b-input type="textarea" minlength="10" maxlength="100"
                             v-model="task.task.data"
                             :disabled="task.task.access == 1"></b-input>
                </b-field>

                <div class="columns">
                    <div class="column is-12">
                        <b-field :label="trans('data.taskTextBody')"
                                 v-if="task.textBody.access >= 1"></b-field>
                        <div id="editor" v-if="task.textBody.access == 2"></div>
                        <div v-if="task.textBody.access == 1"
                             v-html="task.textBody.data">
                        </div>
                    </div>
                </div>

                <b-field :label="trans('data.taskTextPreview')"
                         v-if="task.textPreview.access >= 1">
                    <b-input type="textarea" minlength="10" maxlength="100"
                             v-model="task.textPreview.data"
                             :disabled="task.textPreview.access == 1"></b-input>
                </b-field>

                <b-field :label="trans('data.taskTextUrl')"
                         v-if="task.textUrl.access >= 1">
                    <b-input v-model="task.textUrl.data"
                             :disabled="task.textUrl.access == 1"></b-input>
                </b-field>

                <div class="columns">
                    <div class="column is-12">
                        <b-field :label="trans('data.commentsTitle')"></b-field>
                    </div>
                </div>
            </div>

            <div class="column is-3">
                <b-field :label="trans('data.taskProject')"
                         v-if="task.project.access >= 1">
                    <b-select :placeholder="trans('data.taskProject')"
                              icon-pack="fa"
                              icon="th-list"
                              v-model="task.project.data"
                              :disabled="task.project.access == 1">
                        <option
                                v-for="(val,key) in projects"
                                :value="val.id"
                                :key="key">
                            {{ val.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field :label="trans('data.taskEditor')"
                         v-if="task.editor.access >= 1">
                    <b-select :placeholder="trans('data.taskEditor')"
                              icon-pack="fa"
                              icon="users"
                              v-model="task.editor.data"
                              :disabled="task.editor.access == 1">
                        <option
                                v-for="(val,key) in editors"
                                :value="val.id"
                                :key="key">
                            {{ val.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field :label="trans('data.taskAuthor')"
                         v-if="task.author.access >= 1">
                    <b-select :placeholder="trans('data.taskAuthor')"
                              icon-pack="fa"
                              icon="users"
                              v-model="task.author.data"
                              :disabled="task.author.access == 1">
                        <option
                                v-for="(val,key) in authors"
                                :value="val.id"
                                :key="key">
                            {{ val.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field :label="trans('data.taskSubject')"
                         v-if="task.subject.access >= 1">
                    <b-select :placeholder="trans('data.taskSubject')"
                              icon-pack="fa"
                              icon="align-justify"
                              v-mpdel="task.subject.data"
                              :disabled="task.subject.access == 1">
                        <option
                                v-for="(val,key) in subjects"
                                :value="val.id"
                                :key="key">
                            {{ val.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field :label="trans('data.taskTextMinMax')"
                         v-if="task.textMin.access >= 1 || task.textMax.access >= 1">
                    <div class="columns">
                        <div class="column is-6">
                            <b-input placeholder="min" type="number" min="0"
                                     v-model="task.textMin.data"
                                     v-if="task.textMin.access >= 1"
                                     :disabled="task.textMin.access == 1"></b-input>
                        </div>
                        <div class="column is-6">
                            <b-input placeholder="max" type="number" min="0"
                                     v-model="task.textMax.data"
                                     v-if="task.textMax.access >= 1"
                                     :disabled="task.textMax.access == 1"></b-input>
                        </div>
                    </div>
                </b-field>

                <b-field :label="trans('data.taskTextUnique')"
                         v-if="task.textUnique.access >= 1">
                    <b-input type="number" min="0"
                             v-model="task.textUnique.data"
                             :disabled="task.textUnique.access == 1"></b-input>
                </b-field>

                <b-field :label="trans('data.taskPrice')"
                         v-if="task.price.access >= 1">
                    <b-input type="number" min="0"
                             v-model="task.price.data"
                             :disabled="task.price.access == 1"></b-input>
                </b-field>

                <b-field :label="trans('data.taskDateEnd')"
                         v-if="task.dateEnd.access >= 1">
                    <b-datepicker
                            icon-pack="fa"
                            icon="calendar"
                            :min-date="new Date()"
                            v-model="task.dateEnd.data"
                            :disabled="task.dateEnd.access == 1"></b-datepicker>
                </b-field>
            </div>
        </div>

        <div class="field is-grouped ui-mt-5">
            <button type="button" class="button is-primary control">{{ trans('data.save') }}</button>
            <button type="button" class="button is-link control">{{ trans('data.taskGet') }}</button>
            <button type="button" class="button is-warning control">{{ trans('data.taskReturn') }}</button>
        </div>
    </section>
</template>
<script>
    export default {

        mounted() {

            this.editor = new Jodit(document.getElementById('editor'), {
                buttons: ['source', '|', 'bold', 'italic', '|', 'ul', 'ol', '|', 'font', 'fontsize', 'brush',
                    'paragraph', '|', 'image', 'video', 'table', 'link', '|', 'align', '|', 'undo', 'redo', '|',
                    'hr', 'eraser', 'fullsize', 'copyformat']
            });

            if (this.task_id > 0) {
                this.getTask();
            }

            this.getProject();
            this.getUser();
            this.getSubject();
        },

        props: {
            user_id: {},
            task_id: {}
        },

        data() {
            return {
                task: {
                    name: {
                        data: null,
                        access: 2
                    },
                    title: {
                        data: null,
                        access: 0
                    },
                    desc: {
                        data: null,
                        access: 0
                    },
                    words: {
                        data: null,
                        access: 2
                    },
                    moreData: {
                        data: null,
                        access: 2
                    },
                    task: {
                        data: null,
                        access: 2
                    },
                    textBody: {
                        data: null,
                        access: 0
                    },
                    textPreview: {
                        data: null,
                        access: 0
                    },
                    textUrl: {
                        data: null,
                        access: 0
                    },
                    project: {
                        data: null,
                        access: 2
                    },
                    editor: {
                        data: null,
                        access: 2
                    },
                    author: {
                        data: null,
                        access: 2
                    },
                    subject: {
                        data: null,
                        access: 2
                    },
                    textMin: {
                        data: null,
                        access: 2
                    },
                    textMax: {
                        data: null,
                        access: 2
                    },
                    textUnique: {
                        data: null,
                        access: 2
                    },
                    price: {
                        data: null,
                        access: 2
                    },
                    dateEnd: {
                        data: null,
                        access: 2
                    }
                },
                projects: [],
                editors: [],
                authors: [],
                subjects: []
            }
        },

        methods: {

            /**
             * get users
             * @param role
             */
            getUser() {
                Api.post('v1', 'getUsers')
                    .then(response => {
                        this.editors = response.data.data;
                        this.authors = response.data.data;
                    })
            },

            /**
             * get projects
             */
            getProject() {
                Api.post('v1', 'getProjects')
                    .then(response => {
                        this.projects = response.data.data;
                    })
            },

            /**
             * get subjects
             */
            getSubject() {
                Api.post('v1', 'getSubjects')
                    .then(response => {
                        this.subjects = response.data.data;
                    })
            },

        }
    }
</script>