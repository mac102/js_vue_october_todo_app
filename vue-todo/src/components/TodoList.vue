<template>
  <div>
    <div class="row">
      <div class="columns large-6">
        <h2>Uncompleted ({{unCompletedTodos.length}})</h2>
        <todo v-for="todo in unCompletedTodos" :todo="todo" :key="todo.id" @delete-todo="deleteTodo(todo)" @toogle-todo="toggleTodo(todo)"></todo>
      </div>

      <div class="columns large-6">
        <h2>Completed ({{completedTodos.length}})</h2>
        <todo v-for="todo in completedTodos" :todo="todo" :key="todo.id" @delete-todo="deleteTodo(todo)" @toogle-todo="toggleTodo(todo)"></todo>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import todo from "./todo";

export default {
  name: "TodoList",
  props: ["todos"],
  components: {
    todo
  },
  computed: {
    completedTodos: function() {
      return this.todos.filter(function(todo) {
        return todo.status == 1;
      });
    },
    unCompletedTodos: function() {
      return this.todos.filter(function(todo) {
        return todo.status == 0;
      });
    }
  },
  methods: {
    deleteTodo: function(todo) {
      var todoIndex = this.todos.indexOf(todo);

      this.todos.splice(todoIndex, 1);

      axios.post("http://localhost/vuetodo/api/delete-todo", todo, {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      });
    },
    toggleTodo: function(todo) {
        todo.status = (todo.status == 1 ? 0 : 1);

        axios.post("http://localhost/vuetodo/api/toggle-todo", todo, {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      });
    }
  }
};
</script>

<style type="text/css">
</style>


