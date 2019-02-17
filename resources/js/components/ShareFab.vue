<template>
    <v-btn
            v-if="show()"
            v-model="fab"
            color="accent"
            dark
            fab
            fixed
            bottom
            right
            large
            @click="share"
            :disabled="loading"
            :loading="loading"
    >
        <v-icon>share</v-icon>
    </v-btn>
</template>

<script>
export default {
  name: 'ShareFab',
  data () {
    return {
      fab: false,
      loading: false
    }
  },
  methods: {
    show () {
      if (('share' in navigator)) return true
      return false
    },
    share () {
      this.loading = true
      if (!('share' in navigator)) {
        return
      }
      navigator.share({
        title: 'App Tasques catalanes',
        text: 'Aplicació per gestionar tasques!',
        url: 'https://tasks.sergibaucells.scool.cat'
      })
        .then(() => {
          console.log('Successful share')
          this.loading = false
        })
        .catch(error => {
          console.log('Error sharing:', error)
          this.loading = false
        })
    }
  }
}
</script>
