<template>
        <span>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                      @keydown.esc.stop.prevent="dialog=false">

              <v-btn slot="activator" color="primary">
                  Vibracions
              </v-btn>

                <v-card>

                    <v-toolbar color="primary" class="white--text">
                        <v-btn flat icon class="white--text" @click="dialog=false">
                            <v-icon class="mr-2">close</v-icon>
                        </v-btn>
                        <v-card-title class="headline">Vibracions</v-card-title>
                    </v-toolbar>

                    <v-card-text class="text-xs-center">

                        <v-btn color="primary" @click="vibrateSimple">Vibrate Simple</v-btn>
                        <v-btn color="primary" @click="vibratePattern">Vibrate Pattern</v-btn>

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
  name: 'Vibrate',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    vibrateSimple () {
      navigator.vibrate(200)
    },
    vibratePattern () {
      navigator.vibrate([100, 200, 200, 200, 500])
    }
  }
}
</script>
