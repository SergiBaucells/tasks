<template>
    <span>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                      @keydown.esc.stop.prevent="dialog=false">

              <v-btn slot="activator" @click="geolocation" color="primary">
                  Geocalització
              </v-btn>

                <v-card>

                    <v-toolbar color="primary" class="white--text">
                        <v-btn flat icon class="white--text" @click="dialog=false">
                            <v-icon class="mr-2">close</v-icon>
                        </v-btn>
                        <v-card-title class="headline">Geocalització</v-card-title>
                    </v-toolbar>

                    <v-card-text class="text-xs-center">

                        <v-btn color="primary" id="askButton">Pregunta per localització</v-btn>

                        <div id="target"></div>

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
    geolocation () {
      let target = document.getElementById('target')
      let watchId

      function appendLocation (location, verb) {
        verb = verb || 'updated'
        let newLocation = document.createElement('p')
        newLocation.innerHTML = 'Location ' + verb + ': <a href="https://maps.google.com/maps?&z=15&q=' + location.coords.latitude + '+' + location.coords.longitude + '&ll=' + location.coords.latitude + '+' + location.coords.longitude + '" target="_blank">' + location.coords.latitude + ', ' + location.coords.longitude + '</a>'
        target.appendChild(newLocation)
      }

      if ('geolocation' in navigator) {
        document.getElementById('askButton').addEventListener('click', function () {
          navigator.geolocation.getCurrentPosition(function (location) {
            appendLocation(location, 'fetched')
          })
          watchId = navigator.geolocation.watchPosition(appendLocation)
        })
      } else {
        target.innerText = 'Geolocation API not supported.'
      }
    }
  }
}
</script>
