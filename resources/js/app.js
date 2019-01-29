import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import AppComponent from './components/App.vue'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks.vue'
import Tasques from './components/Tasques.vue'
import Tags from './components/Tags.vue'
import LoginForm from './components/LoginForm.vue'
import RegisterForm from './components/RegisterForm.vue'
import GitInfo from './components/git/GitInfoComponent.vue'
import UserList from './components/UserList'
import UserSelect from './components/UserSelect'
import permissions from './plugins/permissions'
import snackbar from './plugins/snackbar'
import confirm from './plugins/confirm'
import Impersonate from './components/Impersonate'
import Color from './components/ColorTheme'
import Profile from './components/Profile'
import TreeView from 'vue-json-tree-view'
import Changelog from './components/changelog/ChangelogComponent.vue'
import VueTimeago from 'vue-timeago'
import ServiceWorker from './components/ServiceWorker.vue'
import Navigation from './components/Navigation'
import NotificationsWidget from './components/NotificationsWidget.vue'

window.Vue = Vue
window.Vuetify = Vuetify

window.Vue.use(VueTimeago, {
  locale: 'ca', // Default locale
  locales: {
    'ca': require('date-fns/locale/ca')
  }
})

const PRIMARY_COLOR_KEY = 'PRIMARY_COLOR_KEY'
const SECONDARY_COLOR_KEY = 'SECONDARY_COLOR_KEY'
const DETAILS_COLOR_KEY = 'DETAILS_COLOR_KEY'
const primaryColor = window.localStorage.getItem(PRIMARY_COLOR_KEY) || '#F0B429'
const secondaryColor = window.localStorage.getItem(SECONDARY_COLOR_KEY) || '#2BB0ED'
const detailColor = window.localStorage.getItem(DETAILS_COLOR_KEY) || '#C65D21'

window.Vue.use(window.Vuetify, {
  theme: {
    primary: {
      base: primaryColor,
      lighten1: '#F7C948',
      lighten2: '#FADB5F',
      lighten3: '#FCE588',
      lighten4: '#FFF3C4',
      lighten5: '#FFFBEA',
      darken1: '#DE911D',
      darken2: '#CB6E17',
      darken3: '#B44D12',
      darken4: '#8D2B0B'
    },
    secondary: {
      base: secondaryColor,
      lighten1: '#40C3F7',
      lighten2: '#5ED0FA',
      lighten3: '#81DEFD',
      lighten4: '#B3ECFF',
      lighten5: '#E3F8FF',
      darken1: '#1992D4',
      darken2: '#127FBF',
      darken3: '#0B69A3',
      darken4: '#035388'
    },
    accent: {
      base: detailColor,
      lighten1: '#E67635',
      lighten2: '#EF8E58',
      lighten3: '#FAB38B',
      lighten4: '#FFD3BA',
      lighten5: '#FFEFE6',
      darken1: '#AB4E19',
      darken2: '#8C3D10',
      darken3: '#77340D',
      darken4: '#572508'
    },
    error: {
      base: '#E12D39',
      lighten1: '#EF4E4E',
      lighten2: '#F86A6A',
      lighten3: '#FF9B9B',
      lighten4: '#FFBDBD',
      lighten5: '#FFE3E3',
      darken1: '#CF1124',
      darken2: '#AB091E',
      darken3: '#8A041A',
      darken4: '#610316'
    },
    // Taken from palete 3
    success: {
      base: '#27AB83',
      lighten1: '#3EBD93',
      lighten2: '#65D6AD',
      lighten3: '#8EEDC7',
      lighten4: '#C6F7E2',
      lighten5: '#EFFCF6',
      darken1: '#199473',
      darken2: '#147D64',
      darken3: '#0C6B58',
      darken4: '#014D40'
    },
    grey: {
      base: '#7E7E7E',
      lighten1: '#9E9E9E',
      lighten2: '#B1B1B1',
      lighten3: '#CFCFCF',
      lighten4: '#E1E1E1',
      lighten5: '#F7F7F7',
      darken1: '#626262',
      darken2: '#515151',
      darken3: '#3B3B3B',
      darken4: '#222222'
    }
  }
})

window.Vue.use(permissions)
window.Vue.use(snackbar)
window.Vue.use(confirm)

// window.Vue.use(Snackbar)

window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)
window.Vue.component('tasques', Tasques)
window.Vue.component('tags', Tags)
window.Vue.component('login-form', LoginForm)
window.Vue.component('register-form', RegisterForm)
window.Vue.component('user-list', UserList)
window.Vue.component('user-select', UserSelect)
window.Vue.component('impersonate', Impersonate)
window.Vue.component('git-info', GitInfo)
window.Vue.component('color', Color)
window.Vue.component('profile', Profile)
window.Vue.use(TreeView)
window.Vue.component('service-worker', ServiceWorker)
window.Vue.component('navigation', Navigation)
// Changelog
window.Vue.component('changelog', Changelog)
window.Vue.component('notifications-widget', NotificationsWidget)

// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)
