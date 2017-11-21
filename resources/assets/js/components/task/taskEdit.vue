<template>
    <div>

        <div class="ui-grid-block">
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

                <div class="ui-bg bg-wite ui-p-3 ui-mt-3">
                    <div class="ui-grid-block">

                    </div>
                </div>

            </div>
            <div class="ui-grid-4">


            </div>
        </div>

    </div>
</template>
<script>
    export default {

        mounted() {

            /*this.editor = new Jodit(document.getElementById('editor'), {
                 height: 400,
                 buttons: ['source', '|', 'bold', 'italic', '|', 'ul', 'ol', '|', 'font', 'fontsize', 'brush',
                     'paragraph', '|', 'image', 'video', 'table', 'link', '|', 'align', '|', 'undo', 'redo', '|',
                     'hr', 'eraser', 'fullsize', 'copyformat']
             });*/

            if (this.task_id > 0) {
                this.getTask();
            }
        },

        props: {
            user_id: {},
            task_id: {}
        },

        data() {
            return {
                task: {}
            }
        },

        methods: {

            getTask() {

            }
        }
    }
</script>