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

                        <div id="device"></div>

                        <p>L'orientació de la pantalla actual és <b id="orientationType">unknown</b>.</p>

                        <v-btn color="primary" id="lock">Bloquejar</v-btn>
                        <v-btn color="primary" id="unlock">Desbloquejar</v-btn>

                        <p id="logTarget"></p>

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
      var $ = document.getElementById.bind(document)

      var orientKey = 'orientation'
      if ('mozOrientation' in screen) {
        orientKey = 'mozOrientation'
      } else if ('msOrientation' in screen) {
        orientKey = 'msOrientation'
      }

      var target = $('logTarget')
      var device = $('device')
      var orientationTypeLabel = $('orientationType')

      function logChange (event) {
        var timeBadge = new Date().toTimeString().split(' ')[0]
        var newState = document.createElement('p')
        newState.innerHTML = '<span class="badge">' + timeBadge + '</span> ' + event + '.'
        target.appendChild(newState)
      }

      if (screen[orientKey]) {
        function update () {
          var type = screen[orientKey].type || screen[orientKey]
          orientationTypeLabel.innerHTML = type

          var landscape = type.indexOf('landscape') !== -1

          if (landscape) {
            device.style.width = '180px'
            device.style.height = '100px'
          } else {
            device.style.width = '100px'
            device.style.height = '180px'
          }

          var rotate = type.indexOf('secondary') === -1 ? 0 : 180
          var rotateStr = 'rotate(' + rotate + 'deg)'

          device.style.webkitTransform = rotateStr
          device.style.MozTransform = rotateStr
          device.style.transform = rotateStr
        }

        update()

        var onOrientationChange = null

        if ('onchange' in screen[orientKey]) { // newer API
          onOrientationChange = function () {
            logChange('Orientation changed to <b>' + screen[orientKey].type + '</b>')
            update()
          }

          screen[orientKey].addEventListener('change', onOrientationChange)
        } else if ('onorientationchange' in screen) { // older API
          onOrientationChange = function () {
            logChange('Orientation changed to <b>' + screen[orientKey] + '</b>')
            update()
          }

          screen.addEventListener('orientationchange', onOrientationChange)
        }

        // browsers require full screen mode in order to obtain the orientation lock
        var goFullScreen = null
        var exitFullScreen = null
        if ('requestFullscreen' in document.documentElement) {
          goFullScreen = 'requestFullscreen'
          exitFullScreen = 'exitFullscreen'
        } else if ('mozRequestFullScreen' in document.documentElement) {
          goFullScreen = 'mozRequestFullScreen'
          exitFullScreen = 'mozCancelFullScreen'
        } else if ('webkitRequestFullscreen' in document.documentElement) {
          goFullScreen = 'webkitRequestFullscreen'
          exitFullScreen = 'webkitExitFullscreen'
        } else if ('msRequestFullscreen') {
          goFullScreen = 'msRequestFullscreen'
          exitFullScreen = 'msExitFullscreen'
        }

        $('lock').addEventListener('click', function () {
          document.documentElement[goFullScreen] && document.documentElement[goFullScreen]()

          var promise = null
          if (screen[orientKey].lock) {
            promise = screen[orientKey].lock(screen[orientKey].type)
          } else {
            promise = screen.orientationLock(screen[orientKey])
          }

          promise
            .then(function () {
              logChange('Screen lock acquired')
              $('unlock').style.display = 'block'
              $('lock').style.display = 'none'
            })
            .catch(function (err) {
              logChange('Cannot acquire orientation lock: ' + err)
              document[exitFullScreen] && document[exitFullScreen]()
            })
        })

        $('unlock').addEventListener('click', function () {
          document[exitFullScreen] && document[exitFullScreen]()

          if (screen[orientKey].unlock) {
            screen[orientKey].unlock()
          } else {
            screen.orientationUnlock()
          }

          logChange('Screen lock removed.')
          $('unlock').style.display = 'none'
          $('lock').style.display = 'block'
        })
      }
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

    #device {
        margin: 10px;
        border: 1px solid black;
        border-radius: 10px;
    }

    #device:after {
        content: 'A';
        font: 80px serif;
        display: block;
        text-align: center;
    }

    #unlock {
        display: none;
    }
</style>
