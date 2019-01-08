<template>
    <span>
        <tasks-list :users="users" :uri="uri" :tasks="dataTasks" :tags="tags"></tasks-list>
        <tasks-create v-if="$can('user.tasks.store')" :users="users" @created="add" :uri="uri"></tasks-create>
    </span>
</template>

<script>
import TasksCreate from './TasksCreate'
import TasksList from './TasksList'
export default {
  name: 'Tasques',
  components: {
    'tasks-create': TasksCreate,
    'tasks-list': TasksList
  },
  data () {
    return {
      dataTasks: this.tasks
    }
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    add (task) {
      this.dataTasks.push(task)
    }
  }
}
</script>
