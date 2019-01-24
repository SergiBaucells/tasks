<template>
    <span>
        <tasks-list  v-show="dataTasks.length > 0" :users="users" :uri="uri" :tasks="dataTasks" :tags="tags"></tasks-list>
        <no-data-c-t-a-component v-show="dataTasks.length === 0"></no-data-c-t-a-component>
        <tasks-create v-show="dataTasks.length > 0" v-if="$can('user.tasks.store')" :users="users" @created="add" :uri="uri"></tasks-create>
    </span>
</template>

<script>
import TasksCreate from './TasksCreate'
import TasksList from './TasksList'
import NoDataCTAComponent from './NoDataCTAComponent'
export default {
  name: 'Tasques',
  components: {
    'no-data-c-t-a-component': NoDataCTAComponent,
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
