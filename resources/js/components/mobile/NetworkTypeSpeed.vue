<template>
    <span>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                      @keydown.esc.stop.prevent="dialog=false">

              <v-btn slot="activator" @click="networkTypeSpeed" color="primary">
                  Xarxa i velocitat
              </v-btn>

                <v-card>

                    <v-toolbar color="primary" class="white--text">
                        <v-btn flat icon class="white--text" @click="dialog=false">
                            <v-icon class="mr-2">close</v-icon>
                        </v-btn>
                        <v-card-title class="headline">Xarxa i velocitat</v-card-title>
                    </v-toolbar>

                    <v-card-text class="text-xs-center">

                        <p>El tipus de xarxa teòrica actual és <b id="networkType">not available</b>.</p>
                        <p>Tipus de xarxa vigent actual és <b id="effectiveNetworkType">not available</b>.</p>
                        <p>La velocitat màxima actual de l'enllaç descendent és <b id="downlinkMax">not available</b>.</p>

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
  name: 'NetworkTypeSpeed',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    networkTypeSpeed () {
      function getConnection () {
        return navigator.connection || navigator.mozConnection ||
          navigator.webkitConnection || navigator.msConnection
      }

      function updateNetworkInfo (info) {
        document.getElementById('networkType').innerHTML = info.type
        document.getElementById('effectiveNetworkType').innerHTML = info.effectiveType
        document.getElementById('downlinkMax').innerHTML = info.downlinkMax
      }

      let info = getConnection()
      if (info) {
        info.addEventListener('change', updateNetworkInfo)
        updateNetworkInfo(info)
      }
    }
  }
}
</script>
