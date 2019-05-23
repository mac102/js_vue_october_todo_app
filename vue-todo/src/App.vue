<template>
  <div id="app">
    <CreateTodo v-on:create-todo="addTodo"></CreateTodo>
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
</style>
