<template>
    <section>
        <b-loading :active="isLoading"></b-loading>
        <div class="container" v-if="!isLoading">

            <task-contorls @save="saveTask"></task-contorls>

            <b-collapse class="card" :open.sync="isOpenBlock">
                <div slot="trigger" class="card-header">
                    <p class="card-header-title">
                        {{ trans('data.taskBlockMain') }}
                    </p>
                    <a class="card-header-icon">
                        <b-icon :icon="isOpenBlock ?
                        'menu-down' : 'menu-up'">
                        </b-icon>
                    </a>
                </div>
                <div class="card-content">
                    <div class="content">
                        <div class="columns">
                            <div class="column is-3">

                                <b-field :label="trans('data.taskProject')"
                                         v-if="task.project.access >= 1"
                                         :type="task.name.access == 1 ? 'is-warning' : ''">
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

                                <b-field :label="trans('data.taskSubject')"
                                         v-if="task.subject.access >= 1"
                                         :type="task.name.access == 1 ? 'is-warning' : ''">
                                    <b-select :placeholder="trans('data.taskSubject')"
                                              icon-pack="fa"
                                              icon="align-justify"
                                              v-model="task.subject.data.id"
                                              :disabled="task.subject.access == 1">
                                        <option
                                                v-for="(val,key) in subjects"
                                                :value="val.id"
                                                :key="key">
                                            {{ val.name }}
                                        </option>
                                    </b-select>
                                </b-field>
                            </div>
                            <div class="column is-2">

                                <b-field :label="trans('data.taskPrice')"
                                         v-if="task.price.access >= 1"
                                         :type="task.name.access == 1 ? 'is-warning' : ''">
                                    <b-input type="number" min="0"
                                             v-model="task.price.data"
                                             :disabled="task.price.access == 1"></b-input>
                                </b-field>

                                <b-field :label="trans('data.taskTextMinMax')"
                                         v-if="task.textMin.access >= 1 || task.textMax.access >= 1"
                                         :type="task.name.access == 1 ? 'is-warning' : ''">
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
                                         v-if="task.textUnique.access >= 1"
                                         :type="task.name.access == 1 ? 'is-warning' : ''">
                                    <b-input type="number" min="0" max="100"
                                             v-model="task.textUnique.data"
                                             :disabled="task.textUnique.access == 1"></b-input>
                                </b-field>

                            </div>
                            <div class="column is-7">


                            </div>
                        </div>
                    </div>
                </div>
            </b-collapse>

            <b-field class="ui-mt-3" :label="trans('data.taskName')"
                     v-if="task.name.access >= 1"
                     :type="task.name.access == 1 ? 'is-warning' : ''">
                <b-input v-model="task.name.data"
                         :disabled="task.name.access == 1"></b-input>
            </b-field>

            <b-field :label="trans('data.taskTitle')"
                     v-if="task.title.access >= 1"
                     :type="task.name.access == 1 ? 'is-warning' : ''">
                <b-input v-model="task.title.data"
                         :disabled="task.title.access == 1"></b-input>
            </b-field>

            <b-field :label="trans('data.taskDesc')"
                     v-if="task.desc.access >= 1"
                     :type="task.name.access == 1 ? 'is-warning' : ''">
                <b-input type="textarea" minlength="10" maxlength="100"
                         v-model="task.desc.data"
                         :disabled="task.desc.access == 1"></b-input>
            </b-field>

            <div class="columns">
                <div class="column is-6">
                    <b-field :label="trans('data.taskWords')"
                             v-if="task.words.access >= 1"
                             :type="task.name.access == 1 ? 'is-warning' : ''">
                        <b-input type="textarea" minlength="10" maxlength="100"
                                 v-model="task.words.data"
                                 :disabled="task.words.access == 1"></b-input>
                    </b-field>
                </div>
                <div class="column is-6">
                    <b-field :label="trans('data.taskMoreData')"
                             v-if="task.moreData.access >= 1"
                             :type="task.name.access == 1 ? 'is-warning' : ''">
                        <b-input type="textarea" minlength="10" maxlength="100"
                                 v-model="task.moreData.data"
                                 :disabled="task.moreData.access == 1"></b-input>
                    </b-field>
                </div>
            </div>

            <b-field :label="trans('data.taskTask')"
                     v-if="task.task.access >= 1"
                     :type="task.name.access == 1 ? 'is-warning' : ''">
                <b-input type="textarea" minlength="10" maxlength="100"
                         v-model="task.task.data"
                         :disabled="task.task.access == 1"></b-input>
            </b-field>

            <div class="columns">
                <div class="column is-12">
                    <b-field :label="trans('data.taskTextBody')"
                             v-if="task.textBody.access >= 1"
                             :type="task.name.access == 1 ? 'is-warning' : ''">
                    </b-field>
                    <div id="editor" v-if="task.textBody.access == 2"></div>
                    <div v-if="task.textBody.access == 1"
                         v-html="task.textBody.data">
                    </div>
                </div>
            </div>

            <b-field :label="trans('data.taskTextPreview')"
                     v-if="task.textPreview.access >= 1"
                     :type="task.name.access == 1 ? 'is-warning' : ''">
                <b-input type="textarea" minlength="10" maxlength="100"
                         v-model="task.textPreview.data"
                         :disabled="task.textPreview.access == 1"></b-input>
            </b-field>

            <b-field :label="trans('data.taskTextUrl')"
                     v-if="task.textUrl.access >= 1"
                     :type="task.name.access == 1 ? 'is-warning' : ''">
                <b-input v-model="task.textUrl.data"
                         :disabled="task.textUrl.access == 1"></b-input>
            </b-field>

            <div class="columns" v-if="task.id">
                <div class="column is-12">

                    <task-comments :task="task.id" :owner="task.owner.id"></task-comments>

                </div>
            </div>
        </div>

    </section>
</template>
<script>
    Vue.component('taskComments', require('./comments'));
    Vue.component('taskContorls', require('./control'));

    export default {

        mounted() {

            this.$watch('task.textBody.access', function () {
                if (this.task.textBody.access == 2) {
                    new Jodit(document.getElementById('editor'), {
                        buttons: ['source', '|', 'bold', 'italic', '|', 'ul', 'ol', '|', 'font', 'fontsize', 'brush',
                            'paragraph', '|', 'image', 'video', 'table', 'link', '|', 'align', '|', 'undo', 'redo', '|',
                            'hr', 'eraser', 'fullsize', 'copyformat']
                    });
                }
            });


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
                        data: {
                            id: null
                        },
                        access: 2
                    },
                    author: {
                        data: {
                            id: null
                        },
                        access: 2
                    },
                    subject: {
                        data: {
                            id: null
                        },
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
                    owner: {}
                },
                stageDirection: 0,
                //
                isRefresh: false,
                isLoading: false,
                isOpenBlock: true,
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
            saveTask(direction) {
                this.stageDirection = direction;
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
                    id: this.task_id || 0,
                    user_id: this.userID,
                    desc: task.desc.data || '',
                    moreData: task.moreData.data || '',
                    name: task.name.data || '',
                    price: task.price.data || '',
                    project: task.project.data.id || '',
                    subject: task.subject.data.id || '',
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
                    stageDirection: this.stageDirection,
                }
            }

        }
    }
</script>