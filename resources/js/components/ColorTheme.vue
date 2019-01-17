<template>
    <span>
        <div class="text-xs-center">
            <v-card-title class="justify-center">Color principal</v-card-title>
            <swatches v-model="colorPrincipal"></swatches>
            <v-card-title class="justify-center">Color secundari</v-card-title>
            <swatches v-model="colorSecundari"></swatches>
            <v-card-title class="justify-center">Color detalls</v-card-title>
            <swatches v-model="colorDetalls"></swatches>
            <v-btn style="margin-bottom: 15px"
                   color="success"
                   value="Refresh Page"
                   onClick="window.location.reload()">
                <v-icon>save</v-icon>
                Aplicar
            </v-btn>
        </div>
    </span>
</template>

<script>
import Swatches from 'vue-swatches'
// Import the styles too, globally
import 'vue-swatches/dist/vue-swatches.min.css'

export default {
  name: 'Color',
  components: { Swatches },
  data () {
    return {
      colorPrincipal: window.localStorage.getItem('PRIMARY_COLOR_KEY'),
      colorSecundari: window.localStorage.getItem('SECONDARY_COLOR_KEY'),
      colorDetalls: window.localStorage.getItem('DETAILS_COLOR_KEY')
    }
  },
  watch: {
    colorPrincipal () {
      window.localStorage.setItem('PRIMARY_COLOR_KEY', this.colorPrincipal)
    },
    colorSecundari () {
      window.localStorage.setItem('SECONDARY_COLOR_KEY', this.colorSecundari)
    },
    colorDetalls () {
      window.localStorage.setItem('DETAILS_COLOR_KEY', this.colorDetalls)
    }
  }
}
</script>
