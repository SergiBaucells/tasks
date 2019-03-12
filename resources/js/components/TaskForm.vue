<template>
    <v-form>
        <v-text-field
                autofocus
                v-model="name"
                label="Nom"
                hint="Nom de la tasca"
                placeholder="Nom de la tasca"
        ></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripció" hint="Descripció de la tasca"></v-textarea>

        <user-select v-if="$hasRole('TaskManager')" v-model="user" :users="dataUsers" label="Usuari"></user-select>

        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="add" :disabled="loading || $v.$invalid" :loading="loading">
                <v-icon class="mr-1" >save</v-icon>
                Afegir
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required } from 'vuelidate/lib/validators'
import UserSelect from './UserSelect'

export default {
  name: 'TaskForm',
  mixins: [validationMixin],
  validations: {
    name: { required }
  },
  components: {
    'user-select': UserSelect
  },
  data () {
    return {
      name: '',
      completed: false,
      description: '',
      dataUsers: this.users,
      loading: false,
      user: null
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      default: '/api/v1/tasks'
    }
  },
  computed: {
    nameErrors () {
      const errors = []
      if (!this.$v.name.$dirty) return errors
      !this.$v.name.required && errors.push('El camp name és obligatori.')
      return errors
    }
  },
  methods: {
    selectLoggedUser () {
      if (window.laravel_user) {
        this.user = this.users.find((user) => {
          return parseInt(user.id) === parseInt(window.laravel_user.id)
        })
      }
    },
    reset () {
      this.name = ''
      this.description = ''
      this.completed = false
      this.user = null
    },
    add () {
      this.loading = true
      window.axios.post(this.uri, {
        user_id: (this.user !== null) ? this.user.id : null,
        name: this.name,
        completed: this.completed,
        description: this.description
      }).then((response) => {
        this.$snackbar.showMessage("S'ha creat correctament")
        this.reset()
        this.$emit('created', response.data)
        this.$emit('close')
        this.loading = false
      }).catch((error) => {
        this.creating = false
      })
    }
  },
  created () {
    this.selectLoggedUser()
  }
}
</script>
