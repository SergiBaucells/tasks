<template>
    <span>
        <v-dialog v-model="dialog" :fullscreen="$vuetify.breakpoint.smAndDown" transition="dialog-bottom-transition" @keydown.esc="dialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn flat icon class="white--text" @click="dialog=false">
                    <v-icon class="mr-2">close</v-icon>
                </v-btn>
                <v-card-title class="headline">Mostrar tasca</v-card-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="dialog=false">
                    <v-icon class="mr-2">exit_to_app</v-icon>
                    Sortir
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <task-show-form :task="task" :uri="uri" :users="users" @close="dialog=false"></task-show-form>
                </v-card-text>
            </v-card>
        </v-dialog>
        <v-btn v-if="$can('user.tasks.show', task)" icon
               color="secondary" flat
               title="Mostrar la tasca" @click="dialog=true">
            <v-icon>visibility</v-icon>
        </v-btn>
    </span>
</template>

<script>
import TaskShowForm from './TaskShowForm'
export default {
  'name': 'TaskShow',
  components: {
    'task-show-form': TaskShowForm
  },
  data () {
    return {
      dialog: false
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
    users: {
      type: Array,
      required: true
    }
  },
  methods: {
    show (task) {
      this.$emit('show', task)
    }
  }
}
</script>
