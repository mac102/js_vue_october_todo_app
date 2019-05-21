<template>
  <div>
    <h1>Todo component</h1>

    <ul>
      <li v-for="todo in todos">
          <h3>{{ todo.title }}</h3>
          <p>{{ todo.description }}</p>
      </li>
    </ul>
  </div>
</template>

<script>

import axios from 'axios';

export default {
  name: "TodoList",
  data: function() {
    return {
      todos: []
    };
  },

    mounted: function() {
        var _self = this;
        
        axios.get('http://localhost/vuetodo/api/todos').then(function(response) {
            _self.todos = response.data;
        });
    }

};
</script>

<style type="text/css">
</style>


