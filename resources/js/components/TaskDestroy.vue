<template>
    <span>
        <v-btn v-if="$can('user.tasks.destroy', task)" :loading="removing"
               :disabled="removing"
               icon
               color="error"
               flat
               title="Eliminar la tasca" @click="destroy(task)">
            <v-icon>delete</v-icon>
        </v-btn>
    </span>
</template>

<script>
  import EventBus from './../eventBus'

  export default {
  'name': 'TaskDestroy',
  data () {
    return {
      removing: false
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    uri: {
      type: String,
      required: true
    },
    mobile: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    async destroy (task) {
      // ES6 async await
      let result = await this.$confirm('Les tasques esborrades no es poden recuperar!',
        {
          title: 'Esteu segurs?',
          buttonFalseText: 'Cancel·lar',
          buttonTrueText: 'Eliminar',
          color: 'error'
        })
      if (result) {
        this.removing = true
        window.axios.delete(this.uri + '/' + task.id).then(() => {
          this.$snackbar.showMessage("S'ha esborrat correctament")
          this.$emit('removed', task)
          this.$emit('close')
          this.removing = false
        }).catch(error => {
          this.removing = false
        })
      }
    }
  },
  created () {
    EventBus.$on('touch-delete', (event) => {
      if (event.id === this.task.id && this.mobile) {
        this.destroy(this.task)
      }
    })
  }
}
</script>
