<template>
    <div>
        <div>
            <button class="button success addnote" v-on:click="openForm" v-show="!isCreating">Add note</button>

            <div class="todo-create" v-show="isCreating">
                <input type="text" placeholder="Enter title" v-model="titleText" ref="title">
                <textarea placeholder="Enter description" v-model="descriptionText" ref="project"></textarea>
                
                <button class="button success" v-on:click="sendForm">Create</button>
                <button class="button alert" v-on:click="closeForm">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CreateTodo',
        data: function() {
            return {
                isCreating: false,
                titleText: '',
                descriptionText: ''
            }
        },
        methods: {
            openForm: function() {
                this.isCreating = true;
            },
            closeForm: function ()  {
                this.isCreating = false;
            },
            sendForm: function() {
                var title = this.titleText;
                var description = this.descriptionText;

                this.$emit('create-todo', {
                    title,
                    description,
                    status: 0
                });

                this.isCreating = false;

                this.resetFields();
                
            },
            resetFields: function() {
                this.titleText = '';
                this.descriptionText = '';
            }
        }
    }
</script>

<style>
    .todo-create {
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 500px;
        padding: 20px;
        border: 1px solid #ccc;
    }

    .todo-create textarea {
        height: 150px;

    }

    .addnote {
        margin-bottom: 0;
    }
</style>