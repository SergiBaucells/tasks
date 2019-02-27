<template>
    <span>
        <v-btn @click="handleChange">Handle Change</v-btn>
    </span>
</template>

<script>
export default {
  name: 'BatteryStatus',
  methods: {
    handleChange (change) {
      if ('getBattery' in navigator || ('battery' in navigator && 'Promise' in window)) {
        let target = document.getElementById('target')
        let timeBadge = new Date().toTimeString().split(' ')[0]
        let newState = document.createElement('p')
        newState.innerHTML = '<span class="badge">' + timeBadge + '</span> ' + change + '.'
        target.appendChild(newState)
      }
    }
  }
}
</script>
