<template>
    <span>
        <v-toolbar color="primary">
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
                <v-expansion-panel v-if="$vuetify.breakpoint.smAndDown">
                    <v-expansion-panel-content>
                        <div slot="header">Filtres</div>
                        <v-layout wrap>
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
                    </v-expansion-panel-content>
                </v-expansion-panel>
                <v-layout v-else wrap>
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
                    class="hidden-sm-and-down"
            >
                <v-progress-linear slot="progress" color="primary" indeterminate></v-progress-linear>
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
                            <task-completed-toggle :status="task.completed" :task="task" :tags="tags"></task-completed-toggle>
                        </td>
                        <td>
                            <tasks-tags :task="task" :task-tags="task.tags" :tags="tags" @change="refresh(false)"></tasks-tags>
                        </td>
                        <td>
                            <span :title="task.created_at_formatted">{{ task.created_at_human }}</span>
                        </td>
                        <td>
                            <span :title="task.updated_at_formatted">{{ task.updated_at_human }}</span>
                        </td>
                        <td class="d-flex">

                            <task-show v-if="$can('user.tasks.show')" :users="users" :task="task" :uri="uri" :loading="showing" :disabled="showing"></task-show>

                            <task-update v-if="$can('user.tasks.update')" :users="users" :task="task" @updated="updateTask" :uri="uri" :loading="editing" :disabled="editing"></task-update>

                            <task-destroy v-if="$can('user.tasks.destroy')" :task="task" @removed="removeTask" :uri="uri"></task-destroy>

                        </td>
                    </tr>
                </template>
            </v-data-table>
            <v-data-iterator
                    class="hidden-md-and-up"
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
                >
                    <v-flex xs12 pb-3>
                      <v-card color="grey lighten-4" class="elevation-5 mr-2 ml-2" v-touch="{
                                    left: () => call('delete', task)
                            }">
                        <v-layout>
                          <v-flex xs5>
                            <v-img :src="(task.user !== null) ? task.user_gravatar : 'img/user_profile.png'" height="125px" contain></v-img>
                          </v-flex>
                          <v-flex xs7>
                            <v-card-title primary-title>
                              <div>
                                <div class="headline">{{ task.user_name }}</div>
                                <div class="subheading" style="width:160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ task.name }}</div>
                                <div v-if="task.completed" style="color: #1abf00">Completada</div>
                                <div v-else style="color: #8C3D10">Pendent</div>
                              </div>
                            </v-card-title>
                          </v-flex>
                        </v-layout>
                        <v-divider light></v-divider>
                        <v-card-actions class="pa-3 elevation-5">
                          <p style="width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ task.user_email }}</p>
                          <v-spacer></v-spacer>
                            <share-task :task="task"></share-task>
                            <task-show v-if="$can('user.tasks.show')" :users="users" :task="task" :uri="uri" :loading="showing" :disabled="showing"></task-show>
                            <task-update v-if="$can('user.tasks.update')" :users="users" :task="task" @updated="updateTask" :uri="uri" :loading="editing" :disabled="editing"></task-update>
                            <task-destroy v-if="$can('user.tasks.destroy')" :task="task" :mobile="true" @removed="removeTask" :uri="uri"></task-destroy>
                        </v-card-actions>
                      </v-card>
                    </v-flex>
                </v-flex>
            </v-data-iterator>
        </v-card>
    </span>
</template>

<script>
import TaskCompletedToggle from './TaskCompletedToggle'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'
import TaskShow from './TaskShow'
import TasksTags from './TasksTags'
import EventBus from './../eventBus'
import ShareTask from './ShareTask'
export default {
  name: 'TasksList',
  components: {
    'task-completed-toggle': TaskCompletedToggle,
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate,
    'task-show': TaskShow,
    'tasks-tags': TasksTags,
    'share-task': ShareTask
  },
  data () {
    return {
      dataUsers: this.users,
      showDialog: false,
      editDialog: false,
      takeTask: '',
      user: '',
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
        rowsPerPage: -1
      },
      loading: false,
      dataTasks: this.tasks,
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Nom', value: 'name' },
        { text: 'Usuari', value: 'user_id' },
        { text: 'Completat', value: 'completed' },
        { text: 'Etiquetes', value: 'tags' },
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
    tags: {
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
    refresh (message = true) {
      this.loading = true
      window.axios.get(this.uri).then(response => {
        this.dataTasks = response.data
        if (message) this.$snackbar.showMessage("S'ha refrescat correctament")
        this.loading = false
      }).catch(error => {
        this.loading = false
      })
    },
    opcio1 () {
      console.log('TODO OPCIÓ 1')
    },
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
    updateTask () {
      this.refresh()
    },
    call (action, object) {
      EventBus.$emit('touch-' + action, object)
    }
  }
}
</script>
