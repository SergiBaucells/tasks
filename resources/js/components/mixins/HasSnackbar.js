export default {
  data () {
    return {
      snackbarMessage: 'Prova',
      snackbarTimeout: 3000,
      snackbarColor: 'success',
      snackbar: false
    }
  },
  methods: {
    // SNACKBAR
    showMessage (message) {
      this.snackbarMessage = message
      this.snackbarColor = 'success'
      this.snackbar = true
    },
    showError (error) {
      // https://kapeli.com/cheat_sheets/Axios.docset/Contents/Resources/Documents/index
      // Handle errors sections
      if (error) {
        if (error.response) {
          // The request was made and the server responded with a status code
          // that falls out of the range of 2xx
          console.log(error.response.data)
          console.log(error.response.status)
          this.snackbarMessage(error.response.data, 'error', error.response.status)
        } else if (error.request) {
          // The request was made but no response was received
          // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
          // http.ClientRequest in node.js
          console.log('Status:')
          if (navigator.onLine) {
            console.log('online')
          } else {
            console.log('offline')
          }
          console.log(error)
          console.log(error.request)
          if (navigator.onLine) {
            this.snackbarMessage('Error de xarxa', 'error')
          } else {
            this.snackbarMessage('Error de xarxa. Estat de la xarxa: sense connexió', 'error')
          }
        } else {
          // Something happened in setting up the request that triggered an Error
          console.log('Error', error.message)
          this.snackbarMessage(error.message, 'error')
        }
      }
    }
    // SNACKBAR END
  }
}
