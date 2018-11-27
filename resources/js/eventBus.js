import Vue from 'vue'
const EventBus = new Vue()
export default EventBus

// bus.$emit()  // Disparar esdeveniments -> Tags o Tasks dispararem el event show
// bus.$on('show') // Mostrar el snackbar
