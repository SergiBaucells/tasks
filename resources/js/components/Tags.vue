<template>
    <div>
        TODO TAGS
        <v-snackbar
                :timeout="snackbarTimeout"
                :color="snackbarColor"
                v-model="snackbar"
        >
            {{ snackbarMessage }}
            <v-btn dark flat @click="snackbar=false">Tancar</v-btn>
        </v-snackbar>
        <v-btn @click="showMessage('missatge')">Show snackbar message</v-btn>
        <v-btn @click="showError('error')">Show snackbar error</v-btn>
    </div>
</template>

<script>
import HasSnackbar from './mixins/HasSnackbar'

export default {
  name: 'Tags',
  mixins: [HasSnackbar],
  data () {
    return {

    }
  }
}
</script>
