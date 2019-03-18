<template>
    <v-form>
        <v-text-field autofocus v-model="name" label="Nom" hint="Nom de la tasca"
                      placeholder="Nom de la tasca"></v-text-field>

        <v-switch v-model="completed"
                  :label="completed ? 'Completada':'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripció" hint="Descripció de la tasca"></v-textarea>

        <user-select v-if="$hasRole('TaskManager')" v-model="user" :users="dataUsers" label="Usuari"></user-select>

        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="update" :disabled="working || $v.$invalid" :loading="working">
                <v-icon class="mr-1">save</v-icon>
                Guardar
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import UserSelect from './UserSelect'
import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'

export default {
  'name': 'TaskUpdateForm',
  mixins: [validationMixin],
  validations: {
    name: { required }
  },
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
          user_id: this.user.id,
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
