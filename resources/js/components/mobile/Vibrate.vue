<template>
    <span>
        <v-btn @click="vibrateSimple">Vibrate Simple</v-btn>
        <v-btn @click="vibratePattern">Vibrate Pattern</v-btn>
    </span>
</template>

<script>
export default {
  name: 'Vibrate',
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
