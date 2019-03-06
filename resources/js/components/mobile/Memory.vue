<template>
    <span>
Your device memory is ~<b id="result">unknown</b> GiB.
    </span>
</template>

<script>
export default {
  name: 'Memory',
  methods: {
    memory () {
      document.getElementById('result').innerHTML = navigator.deviceMemory || 'unknown'
    }
  }
}
</script>
