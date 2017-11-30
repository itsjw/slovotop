<template>
    <section>
        <div class="field is-grouped">
            <button type="button" class="button is-primary control">{{ trans('data.save') }}</button>
            <button type="button" class="button is-link control">{{ trans('data.taskGet') }}</button>
            <button type="button" class="button is-warning control">{{ trans('data.taskReturn') }}</button>
        </div>

        <div class="columns">
            <div class="column is-9">
                <b-field :label="trans('data.taskName')">
                    <b-input v-model="task.name"></b-input>
                </b-field>

                <b-field :label="trans('data.taskTitle')">
                    <b-input v-model="task.title"></b-input>
                </b-field>

                <b-field :label="trans('data.taskDesc')">
                    <b-input type="textarea" minlength="10" maxlength="100"
                             v-model="task.desc"></b-input>
                </b-field>

                <div class="columns">
                    <div class="column is-6">
                        <b-field :label="trans('data.taskWords')">
                            <b-input type="textarea" minlength="10" maxlength="100"
                                     v-model="task.words"></b-input>
                        </b-field>
                    </div>
                    <div class="column is-6">
                        <b-field :label="trans('data.taskMoreData')">
                            <b-input type="textarea" minlength="10" maxlength="100"
                                     v-model="task.more_data"></b-input>
                        </b-field>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-6">
                        <b-field :label="trans('data.taskTask')">
                            <b-input type="textarea" minlength="10" maxlength="100"
                                     v-model="task.task"></b-input>
                        </b-field>
                    </div>
                    <div class="column is-6">
                        <b-field :label="trans('data.taskRuleText')">
                            <b-input type="textarea" minlength="10" maxlength="100"
                                     v-model="task.rule_text"></b-input>
                        </b-field>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-12">
                        <b-field :label="trans('data.taskTextBody')"></b-field>
                        <div id="editor"></div>
                    </div>
                </div>

                <b-field :label="trans('data.taskTextPreview')">
                    <b-input type="textarea" minlength="10" maxlength="100"
                             v-model="task.text_preview"></b-input>
                </b-field>

                <b-field :label="trans('data.taskTextUrl')">
                    <b-input v-model="task.text_url"></b-input>
                </b-field>

                <div class="columns">
                    <div class="column is-12">
                        <b-field :label="trans('data.commentsTitle')"></b-field>
                    </div>
                </div>
            </div>

            <div class="column is-3">
                <b-field :label="trans('data.taskProject')">
                    <b-select :placeholder="trans('data.taskProject')"
                              icon-pack="fa"
                              icon="th-list">
                        <option
                                v-for="(val,key) in projects"
                                :value="val.id"
                                :key="key">
                            {{ val.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field :label="trans('data.taskEditor')">
                    <b-select :placeholder="trans('data.taskEditor')"
                              icon-pack="fa"
                              icon="users">
                        <option
                                v-for="(val,key) in editors"
                                :value="val.id"
                                :key="key">
                            {{ val.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field :label="trans('data.taskAuthor')">
                    <b-select :placeholder="trans('data.taskAuthor')"
                              icon-pack="fa"
                              icon="users">
                        <option
                                v-for="(val,key) in authors"
                                :value="val.id"
                                :key="key">
                            {{ val.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field :label="trans('data.taskSubject')">
                    <b-select :placeholder="trans('data.taskSubject')"
                              icon-pack="fa"
                              icon="align-justify">
                        <option
                                v-for="(val,key) in subjects"
                                :value="val.id"
                                :key="key">
                            {{ val.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field :label="trans('data.taskTextMinMax')">
                    <div class="columns">
                        <div class="column is-6">
                            <b-input placeholder="min" type="number" min="0" v-model="task.text_min"></b-input>
                        </div>
                        <div class="column is-6">
                            <b-input placeholder="max" type="number" min="0" v-model="task.text_max"></b-input>
                        </div>
                    </div>
                </b-field>

                <b-field :label="trans('data.taskTextUnique')">
                    <b-input type="number" min="0" v-model="task.text_unique"></b-input>
                </b-field>

                <b-field :label="trans('data.taskPrice')">
                    <b-input type="number" min="0" v-model="task.price"></b-input>
                </b-field>

                <b-field :label="trans('data.taskDateEnd')">
                    <b-datepicker
                            icon-pack="fa"
                            icon="calendar"
                            :min-date="new Date()"
                            v-model="task.date_end"></b-datepicker>
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
                task: {},
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
            getUser(role) {
                gql.getItem('v2', 'UserQuery', false, 'user')
                    .then(response => {
                        this.editors = response.data.data.UserQuery;
                        this.authors = response.data.data.UserQuery;
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