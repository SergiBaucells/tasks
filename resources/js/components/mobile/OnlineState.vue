<template>
    <span>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                      @keydown.esc.stop.prevent="dialog=false">

              <v-btn slot="activator" @click="onlineState" color="primary">
                  Estat Online
              </v-btn>

                <v-card>

                    <v-toolbar color="primary" class="white--text">
                        <v-btn flat icon class="white--text" @click="dialog=false">
                            <v-icon class="mr-2">close</v-icon>
                        </v-btn>
                        <v-card-title class="headline">Estat Online</v-card-title>
                    </v-toolbar>

                    <v-card-text class="text-xs-center">

                        <p>Activa / desactiva la conexió de xarxa per veure els canvis.</p>

                        <p>L'estat de conexió inicial era <b id="status">unknown</b>.</p>

                        <div id="targett"></div>

                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="primary" flat @click="dialog = false">
                        Sortir
                      </v-btn>
                    </v-card-actions>
              </v-card>
            </v-dialog>
        </v-layout>

    </span>
</template>

<script>
export default {
  name: 'OnlineState',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    onlineState () {
      document.getElementById('status').innerHTML = navigator.onLine ? 'online' : 'offline'

      let targett = document.getElementById('targett')

      function handleStateChange () {
        let timeBadge = new Date().toTimeString().split(' ')[0]
        let newState = document.createElement('p')
        let state = navigator.onLine ? 'online' : 'offline'
        newState.innerHTML = '<span class="badge">' + timeBadge + "</span> L'estat de conexió ha canviat a <b>" + state + '</b>.'
        targett.appendChild(newState)
      }

      window.addEventListener('online', handleStateChange)
      window.addEventListener('offline', handleStateChange)
    }
  }
}
</script>
