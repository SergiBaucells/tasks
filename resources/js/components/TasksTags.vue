<template>
    <span>
        <v-chip v-for="tag in taskTags" :key="tag.id" v-text="tag.name" :color="tag.color"></v-chip>
        <v-btn icon @click="dialog = true"><v-icon>add</v-icon></v-btn>
        <v-btn icon @click="dialog = true"><v-icon>remove</v-icon></v-btn>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title>Afegiu etiquetes a la tasca</v-card-title>
                <v-card-text>
                    <v-combobox
                            v-model="selectedTags"
                            :items="tags"
                            multiple
                            chips
                            item-text="name"
                            @change="formatTag"
                    >
                        <template slot="selection"
                                  slot-scope="data">
                            <v-chip
                                    :color="data.item.color"
                                    :selected="data.selected"
                                    :disabled="data.disabled"
                                    :key="JSON.stringify(data.item)"
                                    class="v-chip--select-multi"
                                    @input="data.parent.selectItem(data.item)"
                            > {{ data.item.name }}
                            </v-chip>
                        </template>
                    </v-combobox>

                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="dialog = false" :loading="loading" :disabled="loading">Cancel·lar</v-btn>
                    <v-btn color="success" @click="addTag">Afegir</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </span>
</template>
<script>
export default {
  name: 'TasksTags',
  data () {
    return {
      dialog: false,
      loading: false,
      selectedTags: [],
      dataTaskTags: this.taskTags
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    taskTags: {
      type: Array,
      required: true
    }
  },
  watch: {
    taskTags (taskTags) {
      this.dataTaskTags = taskTags
    }
  },
  methods: {
    addTag () {
      this.loading = true
      window.axios.put('/api/v1/tasks/' + this.task.id + '/tags', {
        tags: this.selectedTags.map((tag) => {
          if (tag.id) {
            return tag.id
          } else {
            return tag.name
          }
        })
      }).then(() => {
        this.$snackbar.showMessage('Etiqueta/es afegida/es correctament')
        this.dialog = false
        this.loading = false
        this.$emit('change', this.selectedTags)
      }).catch(error => {
        this.dialog = false
        this.loading = false
      })
    },
    removeTag () {
      // TODO ASYNC PRIMER EXECUTAR UN CONFIRM
      console.log('TODO REMOVE TAG')
      window.axios.delete('/api/v1/tasks/' + this.task.id + '/tag' + this.tag).then(() => {
        this.$snackbar.showMessage('Etiqueta/es eliminada/es correctament')
      }).catch(error => {
      })
    },
    formatTag (event) {
      let value = this.selectedTags[this.selectedTags.length - 1]
      if (typeof value === 'string') {
        this.selectedTags[this.selectedTags.length - 1] = {
          'color': 'grey',
          'name': this.selectedTags[this.selectedTags.length - 1]
        }
      }
    }
  }
}
</script>
