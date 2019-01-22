<template>
    <span></span>
</template>

<script>
export default {
  name: 'ServiceWorker',
  mounted () {
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/service-worker.js')
    } else {
      console.log("Missatge d'error")
    }
  }
}
</script>
