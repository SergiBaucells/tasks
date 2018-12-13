<template>
    <v-form>
        <v-text-field v-model="name" label="Nom" hint="Nom de la tasca"
                      readonly></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completada':'Pendent'"
                  readonly></v-switch>
        <v-textarea v-model="description" label="Descripció" readonly></v-textarea>
        <v-autocomplete :items="dataUsers" label="Usuari" v-model="user" item-text="name"
                        return-object readonly></v-autocomplete>
        <user-select :readonly="true" :users="dataUsers" label="Usuari"></user-select>
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-2">exit_to_app</v-icon>
                Sortir
            </v-btn>
        </div>
    </v-form>
</template>

<script>
import UserSelect from './UserSelect'

export default {
  'name': 'TaskShowForm',
  components: {
    'user-select': UserSelect
  },
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
  }
}
</script>
