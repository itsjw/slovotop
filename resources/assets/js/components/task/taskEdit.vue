<template>
    <div>

        Edit task

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
            return {}
        },

        methods: {

            getTask() {

            }
        }
    }
</script>