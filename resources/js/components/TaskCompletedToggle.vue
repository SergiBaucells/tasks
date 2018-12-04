<template>
    <v-switch :loading="loading" :disabled="loading" v-model="dataTask.completed" :label="dataTask.completed ? 'Completada' : 'Pendent'"></v-switch>
</template>

<script>
export default {
  name: 'taskCompletedToggle',
  data () {
    return {
      dataTask: this.task,
      loading: null
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  watch: {
    dataTask: {
      handler: function (dataTask) {
        if (dataTask.completed) this.completeTask()
        else this.uncompleteTask()
      },
      deep: true
    },
    task (task) {
      this.dataTask = task
    }
  },
  methods: {
    uncompleteTask () {
      window.axios.delete('/api/v1/completed_task/' + this.task.id)
    },
    completeTask () {
      window.axios.post('/api/v1/completed_task/' + this.task.id)
    }
  }
}
</script>
