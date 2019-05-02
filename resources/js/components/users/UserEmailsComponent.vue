<template>
    <v-menu offset-y>
            <v-tooltip bottom slot="activator">
                <v-btn  slot="activator"
                        icon
                        style="margin: 0px"
                        :loading="loading"
                        :disabled="loading">
                    <v-icon color="primary">email</v-icon>
                </v-btn>
                <span>Enviar emails</span>
            </v-tooltip>
        <v-list>
            <v-list-tile >
                <v-list-tile-title>Benvinguda</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="reset">
                <v-list-tile-title>Restauració paraula de pas</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="confirm">
                <v-list-tile-title>Confirmació email personal</v-list-tile-title>
            </v-list-tile>
        </v-list>
    </v-menu>
</template>

<script>
export default {
  name: 'UserEmails',
  data () {
    return {
      loading: false,
      email: null
    }
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  methods: {
    confirm () {
      window.axios.get('/email/resend')
    },
    reset () {
      window.axios.post('/password/email', { 'email': this.user.email }).then((response) => {
        console.log(response)
      }).catch()
    }
  }
}
</script>
