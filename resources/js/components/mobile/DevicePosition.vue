<template>
    <span>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                      @keydown.esc.stop.prevent="dialog=false">

              <v-btn slot="activator" @click="devicePosition" color="primary">
                  Orientació
              </v-btn>

                <v-card>

                    <v-toolbar color="primary" class="white--text">
                        <v-btn flat icon class="white--text" @click="dialog=false">
                            <v-icon class="mr-2">close</v-icon>
                        </v-btn>
                        <v-card-title class="headline">Orientació</v-card-title>
                    </v-toolbar>

                    <v-card-text class="text-xs-center">

                        <table class="table table-striped table-bordered">
                              <tr>
                                <td>Inclinació Esquerra/Dreta [gamma]</td>
                                <td id="doTiltLR"></td>
                              </tr>
                              <tr>
                                <td>Inclinació Avant/Atràs [beta]</td>
                                <td id="doTiltFB"></td>
                              </tr>
                              <tr>
                                <td>Direcció [alpha]</td>
                                <td id="doDirection"></td>
                              </tr>
                        </table>

                        <div class="container" id="logoContainer">
                          <img src="img/catalunya.png" id="imgLogo">
                        </div>

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
  name: 'DevicePosition',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    devicePosition () {
      if ('DeviceOrientationEvent' in window) {
        window.addEventListener('deviceorientation', deviceOrientationHandler, false)
      } else {
        document.getElementById('logoContainer').innerText = 'Device Orientation API not supported.'
      }

      function deviceOrientationHandler (eventData) {
        let tiltLR = eventData.gamma
        let tiltFB = eventData.beta
        let dir = eventData.alpha

        document.getElementById('doTiltLR').innerHTML = Math.round(tiltLR)
        document.getElementById('doTiltFB').innerHTML = Math.round(tiltFB)
        document.getElementById('doDirection').innerHTML = Math.round(dir)

        let logo = document.getElementById('imgLogo')
        logo.style.webkitTransform = 'rotate(' + tiltLR + 'deg) rotate3d(1,0,0, ' + (tiltFB * -1) + 'deg)'
        logo.style.MozTransform = 'rotate(' + tiltLR + 'deg)'
        logo.style.transform = 'rotate(' + tiltLR + 'deg) rotate3d(1,0,0, ' + (tiltFB * -1) + 'deg)'
      }
    }
  }
}
</script>

<style>
    .container {
        perspective: 300px;
        -webkit-perspective: 300px;
    }

    #imgLogo {
        width: 275px;
        margin-left: auto;
        margin-right: auto;
        display: block;
        padding: 15px;
    }
</style>
