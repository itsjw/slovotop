<template>
    <b-loading :active="isLoading"></b-loading>
    <section>
        <div class="field is-grouped">
            <button class="button is-primary control" type="button"
                    :disabled="isRefresh"
                    @click="saveTask()">
                <b-icon
                        pack="fa"
                        :icon="isRefresh ? 'refresh' : 'check'"
                        :custom-class="isRefresh ? 'fa-spin' : ''">
                </b-icon>
                <span>{{ trans('data.save') }}</span>
            </button>
            <button class="button is-link control" type="button"
                    :disabled="isRefresh">
                <b-icon
                        pack="fa"
                        icon="arrow-right">
                </b-icon>
                <span>{{ trans('data.taskGet') }}</span>
            </button>
            <button class="button is-warning control" type="button"
                    :disabled="isRefresh">
                <b-icon
                        pack="fa"
                        icon="arrow-left">
                </b-icon>
                <span>{{ trans('data.taskReturn') }}</span>
            </button>
        </div>

        <div class="columns" v-if="isLoading">
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
                <b-field :label="trans('data.taskDateEnd')"
                         v-if="task.dateEnd.access >= 1">
                    <b-input type="date"
                             icon-pack="fa"
                             icon="calendar"
                             v-model="task.dateEnd.data"
                             :disabled="task.dateEnd.access == 1"></b-input>
                </b-field>

                <b-field :label="trans('data.taskProject')"
                         v-if="task.project.access >= 1">
                    <b-select :placeholder="trans('data.taskProject')"
                              icon-pack="fa"
                              icon="th-list"
                              v-model="task.project.data.id"
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
                                v-for="(val,key) in editor"
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
                                v-for="(val,key) in author"
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
                              v-model="task.subject.data"
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
                    <b-input type="number" min="0" max="100"
                             v-model="task.textUnique.data"
                             :disabled="task.textUnique.access == 1"></b-input>
                </b-field>

                <b-field :label="trans('data.taskPrice')"
                         v-if="task.price.access >= 1">
                    <b-input type="number" min="0"
                             v-model="task.price.data"
                             :disabled="task.price.access == 1"></b-input>
                </b-field>

            </div>
        </div>

        <div class="field is-grouped ui-mt-5">
            <button class="button is-primary control" type="button"
                    :disabled="isRefresh"
                    @click="saveTask()">
                <b-icon
                        pack="fa"
                        :icon="isRefresh ? 'refresh' : 'check'"
                        :custom-class="isRefresh ? 'fa-spin' : ''">
                </b-icon>
                <span>{{ trans('data.save') }}</span>
            </button>
            <button class="button is-link control" type="button"
                    :disabled="isRefresh">
                <b-icon
                        pack="fa"
                        icon="arrow-right">
                </b-icon>
                <span>{{ trans('data.taskGet') }}</span>
            </button>
            <button class="button is-warning control" type="button"
                    :disabled="isRefresh">
                <b-icon
                        pack="fa"
                        icon="arrow-left">
                </b-icon>
                <span>{{ trans('data.taskReturn') }}</span>
            </button>
        </div>
    </section>
</template>
<script>
    export default {

        mounted() {

            if (this.task.textBody.access == 2) {
                this.editor = new Jodit(document.getElementById('editor'), {
                    buttons: ['source', '|', 'bold', 'italic', '|', 'ul', 'ol', '|', 'font', 'fontsize', 'brush',
                        'paragraph', '|', 'image', 'video', 'table', 'link', '|', 'align', '|', 'undo', 'redo', '|',
                        'hr', 'eraser', 'fullsize', 'copyformat']
                });
            }

            if (this.task_id > 0) {
                this.getTask();
            }

            this.getProject();
            this.getUser('editor');
            this.getUser('author');
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
                        data: {
                            id: null
                        },
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
                //
                isRefresh: false,
                isLoading: false,
                projects: [],
                editor: [],
                author: [],
                subjects: []
            }
        },

        methods: {

            /**
             * get task by ID
             */
            getTask() {
                this.isLoading = true;
                Api.post('v1', 'getTask', {id: this.task_id})
                    .then(response => {
                        this.task = response.data.data;
                        this.isLoading = false;
                    })
            },

            /**
             * get users
             * @param role
             */
            getUser(param) {
                Api.post('v1', 'getUserList', {[param]: param})
                    .then(response => {
                        this[param] = response.data.data;
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
                Api.post('v1', 'getSubjectList')
                    .then(response => {
                        this.subjects = response.data.data;
                    })
            },

            /**
             * save task
             */
            saveTask() {
                this.isRefresh = true,
                    Api.post('v1', 'saveTask', this.getTaskData(this.task))
                        .then(response => {
                            this.$toast.open({
                                message: response.data.success,
                                type: 'is-success'
                            });
                            history.pushState(null, null, response.data.id);
                            this.task.id = response.data.id;
                            this.isRefresh = false;
                        })
                        .catch(error => {
                            this.$toast.open({
                                duration: 5000,
                                message: Api.errorSerializer(error.response.data.errors),
                                type: 'is-danger'
                            });
                            this.isRefresh = false;
                        });
            },

            /**
             * get task data fo save
             * @param task
             * @returns {{author: null|string, dateEnd: null|string, desc: null|string, editor: null|string, moreData: null|string, name: null|string, price: null|string, project: null|string, subject: null|string, task: null|string, textBody: null|string, textMax: null|string, textMin: null|string, textPreview: null|string, textUnique: null|string, textUrl: null|string, title: null|string, words: null|string}}
             */
            getTaskData(task) {

                return {
                    user_id: this.userID,
                    author: task.author.data || '',
                    dateEnd: task.dateEnd.data || '',
                    desc: task.desc.data || '',
                    editor: task.editor.data || '',
                    moreData: task.moreData.data || '',
                    name: task.name.data || '',
                    price: task.price.data || '',
                    project: task.project.data || '',
                    subject: task.subject.data || '',
                    task: task.task.data || '',
                    textBody: _.escape(task.textBody.data || ''),
                    textMax: task.textMax.data || '',
                    textMin: task.textMin.data || '',
                    textPreview: task.textPreview.data || '',
                    textUnique: task.textUnique.data || '',
                    textUrl: task.textUrl.data || '',
                    title: task.title.data || '',
                    words: task.words.data || '',
                    status: task.status || 1,
                    stage: task.stage || 0,
                    stageDirection: 1,
                }
            }

        }
    }
</script>