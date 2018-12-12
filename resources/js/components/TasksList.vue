<template>
    <span>
        <v-toolbar color="blue">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile @click="opcio1">
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://www.google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
            <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <v-layout row wrap>
                    <v-flex lg3 class="pr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="filter"
                                item-text="name"
                                :return-object="true"
                        ></v-select>
                    </v-flex>
                    <v-flex lg4 class="pr-2">
                        <user-select :users="dataUsers" label="Usuari"></user-select>
                    </v-flex>
                    <v-flex lg5>
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="getFilteredTasks"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
                    class="hidden-md-and-down"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item:task}">
                    <tr>
                        <td>{{task.id}}</td>
                        <td>
                            <span :title="task.description">{{ task.name }}</span>
                        </td>
                        <td>
                            <v-avatar :title="(task.user !== null) ? task.user_name + ' - ' + task.user_email : ''">
                                <img :src="(task.user !== null) ? task.user_gravatar : 'img/user_profile.png'"
                                     alt="avatar">
                            </v-avatar>
                            {{ task.user_email }}
                        </td>
                        <td>
                            <task-completed-toggle :task="task"></task-completed-toggle>
                            <!--<toggle :completed="task.completed" :id="task.id"></toggle>-->
                        </td>
                        <td>
                            <span :title="task.created_at_formatted">{{ task.created_at_human }}</span>
                        </td>
                        <td>
                            <span :title="task.updated_at_formatted">{{ task.updated_at_human }}</span>
                        </td>
                        <td>
                            <v-btn v-if="$can('user.tasks.show', tasks)" :loading="showing" :disabled="showing" icon
                                   color="primary" flat
                                   title="Mostrar la tasca" @click="showTask(task)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn v-if="$can('user.tasks.update', tasks)" :loading="editing" :disabled="editing" icon
                                   color="success" flat
                                   title="Actualitzar la tasca" @click="showUpdate(task)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn v-if="$can('user.tasks.destroy', tasks)" :loading="removing === task.id"
                                   :disabled="removing === task.id" icon
                                   color="error"
                                   flat
                                   title="Eliminar la tasca" @click="destroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <v-data-iterator
                    class="hidden-lg-and-up"
                    :items="dataTasks"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
            >
                <v-flex
                        slot="item"
                        slot-scope="{item:task}"
                        xs12
                        sm6
                        md4
                >
                    <v-card class="mb-1">
                        <v-card-title v-text="task.name"></v-card-title>
                        <v-list dense>
                            <v-list-tile>
                              <v-list-tile-content>Completed:</v-list-tile-content>
                              <v-list-tile-content class="align-end">{{ task.completed }}</v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile>
                              <v-list-tile-content>User:</v-list-tile-content>
                              <v-list-tile-content class="align-end">{{ task.user_id }}</v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card>
                </v-flex>
            </v-data-iterator>
        </v-card>
    </span>
</template>

<script>
import TaskCompletedToggle from './TaskCompletedToggle'
export default {
  name: 'TasksList',
  components: {
    'task-completed-toggle': TaskCompletedToggle
  },
  data () {
    return {
      dataUsers: this.users,
      showDialog: false,
      editDialog: false,
      takeTask: '',
      user: '',
      removing: false,
      showing: false,
      editing: false,
      usersold: [
        'Sergi Baucells',
        'Jordi baucells',
        'Carmen Rodríguez'
      ],
      filter: { name: 'Totes', value: null },
      filters: [
        { name: 'Totes', value: null },
        { name: 'Completades', value: true },
        { name: 'Pendents', value: false }
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      dataTasks: this.tasks,
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Nom', value: 'name' },
        { text: 'Usuari', value: 'user_id' },
        { text: 'Completat', value: 'completed' },
        { text: 'Creat', value: 'created_at_timestamp' },
        { text: 'Modificat', value: 'updated_at_timestamp' },
        { text: 'Accions', sortable: false, value: 'full_search' }
      ]
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
  computed: {
    getFilteredTasks () {
      return this.dataTasks.filter((task) => {
        if (task.completed === this.filter.value || this.filter.value == null) return true
        else return false
      })
    }
  },
  methods: {
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
    },
    showTask (task) {
      this.takeTask = task
      this.showDialog = true
    },
    refresh () {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        // SHOW SNACKBAR MISSATGE OK
        this.dataTasks = response.data
        // this.showMessage("S'ha refrescat correctament")
        this.$snackbar.showMessage("S'ha refrescat correctament")
        this.loading = false
      }).catch(error => {
        this.$snackbar.showError(error.message)
        this.loading = false
        // SHOW SNACKBAR ERROR
      })
    },
    opcio1 () {
      console.log('TODO OPCIÓ 1')
    },
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
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
        // OK tirem endevant
        this.removing = task.id
        window.axios.delete(this.uri + '/' + task.id).then(() => {
          this.removeTask(task)
          task = null
          this.$snackbar.showMessage("S'ha esborrat correctament")
          this.removing = null
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.removing = null
        })
      }
    }
  }
}
</script>
