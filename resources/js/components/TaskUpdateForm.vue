<template>
    <v-form>
        <v-text-field v-model="name" label="Nom" hint="Nom de la tasca"
                      placeholder="Nom de la tasca"></v-text-field>

        <v-switch v-model="completed"
                  :label="completed ? 'Completada':'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripció"></v-textarea>

        <user-select v-if="$hasRole('TasksManager')" v-model="user" :users="dataUsers" label="Usuari"></user-select>

        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-2">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="update" :disabled="working" :loading="working">
                <v-icon class="mr-2">save</v-icon>
                Guardar
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import UserSelect from './UserSelect'

export default {
  'name': 'TaskUpdateForm',
  components: {
    'user-select': UserSelect
  },
  data () {
    return {
      name: this.task.name,
      completed: this.task.completed,
      description: this.task.description,
      user: null,
      dataUsers: this.users,
      working: false
    }
  },
  watch: {
    task (task) {
      this.updateUser(task)
    }
  },
  props: {
    task: {
      type: Object,
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
    update () {
      this.working = true
      window.axios.put(this.uri + '/' + this.task.id,
        {
          user: this.user,
          name: this.name,
          completed: this.completed,
          description: this.description
        }
      ).then((response) => {
        this.$emit('updated', response.data)
        this.$emit('close')
        this.working = false
        this.$snackbar.showMessage("S'ha actualitzat correctament")
      }).catch(error => {
        this.$snackbar.showError(error.message)
        this.working = false
      })
    },
    updateUser (task) {
      this.user = this.users.find((user) => {
        return parseInt(user.id) === parseInt(task.user_id)
      })
    }
  },
  created () {
    this.updateUser(this.task)
  }
}
</script>
