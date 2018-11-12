<template>
    <span>
        <v-dialog v-model="deleteDialog" width="500">
            <v-card>TODO DELETE DIALOG</v-card>
        </v-dialog>
        <v-dialog v-model="createDialog" fullscreen>
            <v-card>TODO CREATE DIALOG</v-card>
        </v-dialog>

        <v-snackbar
            :timeout="3000"
            color="success"
            v-model="snackbar"
        >
            Això es un snackbar
            <v-btn dark flat @click="snackbar=false">Tancar</v-btn>
        </v-snackbar>
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
                <v-layout>
                    <v-flex xs3 class="mr-2">
                        <v-select
                                label="Filtres"
                                :items="filters"
                                v-model="filter"
                        ></v-select>
                    </v-flex>
                    <v-flex xs4 class="mr-2">
                        <v-select
                                label="Usuari"
                                :items="users"
                                v-model="user"
                                clearable
                        ></v-select>
                    </v-flex>
                    <v-flex xs5>
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
                    :items="dataTasks"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item:task}">
                    <tr>
                        <td>{{task.id}}</td>
                        <td v-text="task.name"></td>
                        <td v-text="task.user_id"></td>
                        <td v-text="task.completed"></td>
                        <td v-text="task.create_at"></td>
                        <td v-text="task.update_at"></td>
                        <td>
                            <v-btn icon color="primary" flat title="Mostrar snackbar" @click="snackbar=true">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn :loading="showing" :disabled="showing" icon color="primary" flat title="Mostrar la tasca" @click="show(task)">
                                <v-icon>search</v-icon>
                            </v-btn>
                            <v-btn :loading="editing" :disabled="editing" icon color="success" flat title="Actualitzar la tasca" @click="update(task)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn :loading="deleting" :disabled="deleting" icon color="error" flat title="Eliminar la tasca" @click="showDestroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card>
        <v-btn fab bottom right color="pink" fixed class="white--text" @click="showCreate">
            <v-icon>add</v-icon>
        </v-btn>
    </span>
</template>

<script>

export default {
  name: 'Tasques',
  data () {
    return {
      createDialog: false,
      deleteDialog: false,
      snackbar: true,
      user: '',
      users: [
        'Sergi Baucells',
        'Jordi baucells',
        'Carmen Rodríguez'
      ],
      filter: 'Totes',
      filters: [
        'Totes',
        'Completades',
        'Pendents'
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      deleting: false,
      showing: false,
      editing: false,
      dataTasks: this.tasks,
      headers: [
        {
          text: 'Id',
          value: 'id'
        },
        {
          text: 'Nom',
          value: 'name'
        },
        {
          text: 'Usuari',
          value: 'user_id'
        },
        {
          text: 'Completat',
          value: 'completed'
        },
        {
          text: 'Creat',
          value: 'created_at'
        },
        {
          text: 'Modificat',
          value: 'update_at'
        },
        {
          text: 'Accions',
          sortable: false
        }
      ]
    }
  },
  props: {
    tasks: {
      type: Array,
      required: false
    }
  },
  methods: {
    refresh () {
      this.loading = true
      // setTimeout(() => { this.loading = false }, 5000)
      // OCO!! URL CANVIA SEGONS EL CAS
      // window.axios.get('/api/v1/tasks').then().catch()
      window.axios.get('/api/v1/user/tasks').then(response => {
        // SHOW SNACKBAR MISSATGE OK
        this.dataTasks = response.data
      }).catch(error => {
        console.log(error)
        // SHOW SNACKBAR ERROR
      })
    },
    opcio1 () {
      console.log('TODO OPCIÓ 1')
    },
    showDestroy (task) {
      this.deleteDialog = true
      this.deleting = true
      setTimeout(() => { this.deleting = false }, 5000)
      console.log('TODO ESBORRAR TASCA ' + task.id)
    },
    destroy (task) {
      this.deleting = true
      setTimeout(() => { this.deleting = false }, 5000)
      console.log('TODO ESBORRAR TASCA ' + task.id)
    },
    showCreate (task) {
      this.createDialog = true
      console.log('TODO CREAR TASCA')
    },
    create (task) {
      console.log('TODO CREAR TASCA')
    },
    update (task) {
      this.editing = true
      setTimeout(() => { this.editing = false }, 5000)
      console.log('TODO ACTUALITZAR TASCA ' + task.id)
    },
    show (task) {
      this.showing = true
      setTimeout(() => { this.showing = false }, 5000)
      console.log('TODO MOSTRAR TASCA ' + task.id)
    }
  }
}
</script>

<style>

</style>
