<template>
    <span>
        <v-dialog v-model="editDialog" fullscreen transition="dialog-bottom-transition" @keydown.esc="editDialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn flat icon class="white--text" @click="editDialog=false">
                    <v-icon class="mr-2">close</v-icon>
                </v-btn>
                <v-card-title class="headline">Editar tasca</v-card-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="editDialog=false">
                    <v-icon class="mr-2">exit_to_app</v-icon>
                    Sortir
                </v-btn>
                <v-btn flat class="white--text" @click="update">
                    <v-icon class="mr-2">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="taskBeingUpdated.name" label="Nom" hint="Nom de la tasca"
                                      placeholder="Nom de la tasca"></v-text-field>
                        <v-switch v-model="taskBeingUpdated.completed"
                                  :label="taskBeingUpdated.completed ? 'Completada':'Pendent'"></v-switch>
                        <v-textarea v-model="taskBeingUpdated.description" label="Descripció"></v-textarea>
                        <v-autocomplete v-if="$can('tasks.index')" :items="dataUsers" v-model="taskBeingUpdated.user" label="Usuari"
                                        item-text="name" :return-object="true"></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="editDialog=false">
                                <v-icon class="mr-2">exit_to_app</v-icon>
                                Cancel·lar
                            </v-btn>
                            <v-btn color="success" @click="update">
                                <v-icon class="mr-2">save</v-icon>
                                Guardar
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-dialog v-model="showDialog" fullscreen transition="dialog-bottom-transition" @keydown.esc="showDialog=false">
            <v-toolbar color="primary" class="white--text">
                <v-btn flat icon class="white--text" @click="showDialog=false">
                    <v-icon class="mr-2">close</v-icon>
                </v-btn>
                <v-card-title class="headline">Mostrar tasca</v-card-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="showDialog=false">
                    <v-icon class="mr-2">exit_to_app</v-icon>
                    Sortir
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="takeTask.name" label="Nom" hint="Nom de la tasca"
                                      readonly></v-text-field>
                        <v-switch v-model="takeTask.completed" :label="takeTask.completed ? 'Completada':'Pendent'"
                                  readonly></v-switch>
                        <v-textarea v-model="takeTask.description" label="Descripció" readonly></v-textarea>
                        <v-autocomplete :items="dataUsers" label="Usuari" v-model="takeTask.user" item-text="name"
                                        return-object readonly></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="showDialog=false">
                                <v-icon class="mr-2">exit_to_app</v-icon>
                                Sortir
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <tasks-list :users="users" :uri="uri" :tasks="tasks"></tasks-list>
        <tasks-create v-if="$can('user.tasks.store', tasks)" :users="users" @created="add" :uri="uri"></tasks-create>
    </span>
</template>

<script>
import TaskCompletedToggle from './TaskCompletedToggle'
import Toggle from './Toggle'
import TasksCreate from './TasksCreate'
import TasksList from './TasksList'
import UserSelect from './UserSelect'
export default {
  name: 'Tasques',
  components: {
    'tasks-create': TasksCreate,
    'tasks-list': TasksList,
    'task-completed-toggle': TaskCompletedToggle,
    'toggle': Toggle,
    'user-select': UserSelect
  },
  data () {
    return {
      editDialog: false,
      showDialog: false,
      completed: false,
      name: '',
      description: '',
      dataUsers: this.users,
      takeTask: '',
      taskBeingUpdated: '',
      showing: false,
      editing: false,
      dataTasks: this.tasks
    }
  },
  props: {
    tasks: {
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
    },
    update () {
      this.editing = true
      window.axios.put(this.uri + '/' + this.taskBeingUpdated.id,
        {
          user_id: this.taskBeingUpdated.user.id,
          name: this.taskBeingUpdated.name,
          completed: this.taskBeingUpdated.completed,
          description: this.taskBeingUpdated.description
        }
      ).then(() => {
        this.editDialog = false
        this.taskBeingRemoved = null
        this.$snackbar.showMessage("S'ha actualitzat correctament")
        this.editing = false
      }).catch(error => {
        this.$snackbar.showError(error.message)
        this.editing = false
      })
    },
    showUpdate (task) {
      this.editDialog = true
      this.taskBeingUpdated = task
    }
  }
}
</script>
