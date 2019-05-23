<template>
  <div id="app">
    <div class="header primary">
        <h1>Vue2 + OctoberCms Todo list</h1>    
    </div>  
    <CreateTodo class="create-form" v-on:create-todo="addTodo"></CreateTodo>
    <TodoList :todos="todos"></TodoList>
  </div>
</template>

<script>
import axios from "axios";
import TodoList from "./components/TodoList";
import CreateTodo from "./components/CreateTodo";

export default {
  name: "App",
  components: {
    TodoList,
    CreateTodo
  },
  data: function() {
    return {
      todos: []
    };
  },

  mounted: function() {
    var _self = this;

    axios.get("http://localhost/vuetodo/api/todos").then(function(response) {
      _self.todos = response.data;
    });
  },

  methods: {
    addTodo: function(todo) {

      var _self_todos = this.todos;

      axios
        .post(
            "http://localhost/vuetodo/api/add-todo",
            todo,
            { 
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            },
        )
        .then(function(response) {
            _self_todos.push(todo);
          console.log(response);  
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>

<style>
    .header {
        text-align: center;
        background-color: #1779ba;
        color: #fefefe;
    }

    .header h1 {
        margin-bottom: 0;
    }

    .create-form {
        position: relative;
        text-align: center;
        border-bottom:  1px solid #ccc;
        padding: 10px;
        background: floralwhite;
    }

    .button {
        border-radius: 8px;
    }
</style>
