<template>
    <span>
        <v-layout row justify-center>
            <v-dialog v-model="dialog" :fullscreen="$vuetify.breakpoint.smAndDown" hide-overlay transition="dialog-bottom-transition"
                      @keydown.esc.stop.prevent="dialog=false">

              <v-btn slot="activator" @click="batteryStatus" color="primary">
                  Estat bateria
              </v-btn>

                <v-toolbar color="primary" class="white--text">
                    <v-btn flat icon class="white--text" @click="dialog=false">
                        <v-icon class="mr-2">close</v-icon>
                    </v-btn>
                    <v-card-title class="headline">Estat de la bateria</v-card-title>
                </v-toolbar>
                <v-card>
                    <v-card-text class="text-xs-center">

                        <p>
                            Estat <b id="charging">unknown</b> -
                            Temps de càrrega <b id="chargingTime">unknown</b> -
                            Temps de descàrrega <b id="dischargingTime">unknown</b> -
                            Nivell bateria <b id="level">unknown</b>
                        </p>

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
  name: 'Battery',
  data () {
    return {
      dialog: false
    }
  },
  methods: {
    batteryStatus () {
      if ('getBattery' in navigator || ('battery' in navigator && 'Promise' in window)) {
        let target = document.getElementById('target')
        function handleChange (change) {
          let timeBadge = new Date().toTimeString().split(' ')[0]
          let newState = document.createElement('p')
          newState.innerHTML = '<span class="badge">' + timeBadge + '</span> ' + change + '.'
          target.appendChild(newState)
        }
        function onChargingChange () {
          handleChange('Battery charging changed to <b>' + (this.charging ? 'carregant' : 'descarregant') + '</b>')
        }
        function onChargingTimeChange () {
          handleChange('Battery charging time changed to <b>' + this.chargingTime + ' s</b>')
        }
        function onDischargingTimeChange () {
          handleChange('Battery discharging time changed to <b>' + this.dischargingTime + ' s</b>')
        }
        function onLevelChange () {
          handleChange('Battery level changed to <b>' + this.level + '</b>')
        }
        let batteryPromise
        if ('getBattery' in navigator) {
          batteryPromise = navigator.getBattery()
        } else {
          batteryPromise = Promise.resolve(navigator.battery)
        }
        batteryPromise.then(function (battery) {
          document.getElementById('charging').innerHTML = battery.charging ? 'carregant' : 'descarregant'
          document.getElementById('chargingTime').innerHTML = battery.chargingTime + ' s'
          document.getElementById('dischargingTime').innerHTML = battery.dischargingTime + ' s'
          document.getElementById('level').innerHTML = battery.level
          battery.addEventListener('chargingchange', onChargingChange)
          battery.addEventListener('chargingtimechange', onChargingTimeChange)
          battery.addEventListener('dischargingtimechange', onDischargingTimeChange)
          battery.addEventListener('levelchange', onLevelChange)
        })
      }
    }
  }
}
</script>
