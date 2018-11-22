import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks.vue'
import Tasques from './components/Tasques.vue'
import LoginForm from './components/LoginForm.vue'
import UserList from './components/UserList'
import UserSelect from './components/UserSelect'
import moment from 'moment'

window.Vue = Vue
window.Vue.use(Vuetify)

// Created+Updated_at formatat
window.Vue.filter('formatDate', function (value) {
  if (value) {
    return moment(String(value)).format('DD/MM/YYYY hh:mm')
  }
})

// window.Vue.use(Snackbar)

window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)
window.Vue.component('tasques', Tasques)
window.Vue.component('login-form', LoginForm)
window.Vue.component('user-list', UserList)
window.Vue.component('user-select', UserSelect)

// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)
