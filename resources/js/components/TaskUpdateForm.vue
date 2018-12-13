<template>
    <v-form>
        <v-text-field v-model="name" label="Nom" hint="Nom de la tasca"
                      placeholder="Nom de la tasca"></v-text-field>

        <v-switch v-model="completed"
                  :label="completed ? 'Completada':'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripció"></v-textarea>

        <v-autocomplete v-if="$can('tasks.index')" :items="dataUsers" v-model="user"
                        label="Usuari"
                        item-text="name" :return-object="true"></v-autocomplete>

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
export default {
  'name': 'TaskUpdateForm',
  data () {
    return {
      name: this.task.name,
      completed: this.task.completed,
      description: this.task.description,
      user: this.task.user,
      dataUsers: this.users,
      working: false
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
    }
  }
}
</script>
