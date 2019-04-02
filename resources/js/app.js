import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
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
import Notifications from './components/notifications/Notifications'
import ShareFab from './components/ShareFab'
import ImgWebp from './components/ImgWebp.vue'
import VParallaxWebp from './components/VParallaxWebp.vue'
import MainToolbar from './components/MainToolbar.vue'
import UserInfoDrawer from './components/UserInfoDrawer.vue'
import NewsLetterSubscriptionCard from './components/newsletter/NewsLetterSubscriptionCard.vue'
import Vibrate from './components/mobile/Vibrate.vue'
import BatteryStatus from './components/mobile/BatteryStatus.vue'
import Memory from './components/mobile/Memory.vue'
import OnlineState from './components/mobile/OnlineState.vue'
import NetworkTypeSpeed from './components/mobile/NetworkTypeSpeed.vue'
import DevicePosition from './components/mobile/DevicePosition.vue'
import Geolocation from './components/mobile/Geolocation.vue'
import Newsletters from './components/newsletters/Newsletters.vue'
import Clock from './components/clock/Clock.vue'
import ShowOneTask from './components/ShowOneTask.vue'
import Chat from './components/chat/Chat.vue'
import UsersList from './components/users/UsersList.vue'
import GamepadStickSimple from './components/games/GamepadStickSimple.vue'
import '../img/catalunya.png'
import '../img/catalunya.webp'
import '../img/portada.jpg'
import '../img/portada.webp'
import '../img/portada2.jpg'
import '../img/portada2.webp'
import 'typeface-montserrat/index.css'
import 'typeface-roboto/index.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

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

window.axios.interceptors.response.use((response) => {
  return response
}, function (error) {
  if (window.disableInterceptor) return Promise.reject(error)
  if (error && error.response) {
    // Refresh CSRF TOKEN
    // dAMpDXBRrjVJ2TKewouYHgOeozZmW72EiAt5K1jY
    console.log('PROVA ###############')
    if (error.response.status === 419) {
      console.log('419 error intercepted!!!!!')
      return window.helpers.getCsrfToken().then((token) => {
        console.log('TOKEN OBTAINED:')
        console.log(token)
        window.helpers.updateCsrfToken(token)
        console.log('csrf token updated!')
        error.config.headers['X-CSRF-TOKEN'] = token
        console.log('resend request!!!')
        return window.axios.request(error.config)
      }).catch(e => {
        console.log("NO s'ha pogut obtenir el CSRFTOKEN")
        console.log(e)
      })
    }
    console.log('1')
    if (error.response.status === 401) {
      window.Vue.prototype.$snackbar.showError("No heu entrat al sistema o ha caducat la sessió. Renviant-vos a l'entrada del sistema")
      const loginUrl = location.pathname ? '/login?back=' + location.pathname : '/login'
      console.log('Waiting to redirect to:')
      console.log(loginUrl)
      setTimeout(function () { window.location = loginUrl }, 3000)
      // Break the promise chain -> https://github.com/axios/axios/issues/715
      return new Promise(() => {})
    }
    if (error.response.status === 403) {
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 403!',
        'error',
        'No teniu permisos per realitzar aquesta acció.',
        'center'
      )
    }
    console.log('2')
    if (error.response.status === 422) {
      console.log('%%%%%%%%%%%%%%%%% ERROR DE VALIDACIó %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        error.response.data.message,
        'error',
        window.helpers.printObject(error.response.data.errors),
        'center'
      )
    }
    console.log('3')
    if (error.response.status === 404) {
      console.log('%%%%%%%%%%%%%%%%% NOT FOUND ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 404!',
        'error',
        "No s'ha pogut trobar al servidor el recurs que demaneu.",
        'center'
      )
    }
    if (error.response.status === 405) {
      console.log('%%%%%%%%%%%%%%%%% METHOD NOT ALLOWED FOUND ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 405!',
        'error',
        'Tipus de petició HTTP incorrecte.',
        'center'
      )
    }
    if (error.response.status === 500) {
      console.log('%%%%%%%%%%%%%%%%% SERVER ERROR %%%%%%%%%%%%%%%')
      console.log(error.response)
      console.log(error.response.data)
      console.log(error.response.data.message)
      console.log(error.response.data.errors)
      window.Vue.prototype.$snackbar.showSnackBar(
        'Error 500!',
        'error',
        'Error inesperat al servidor',
        'center'
      )
    }
    return Promise.reject(error)
  }
  if (error.request) {
    window.Vue.prototype.$snackbar.showError("Error de xarxa! No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.")
    window.Vue.prototype.$snackbar.showSnackBar('Error de xarxa!', 'error', "No s'ha obtingut cap resposta a la vostra petició. Consulteu l'estat de la xarxa.")
    return Promise.reject(error)
  }
})

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
window.Vue.component('share-fab', ShareFab)
window.Vue.component('main-toolbar', MainToolbar)
window.Vue.component('user-info-drawer', UserInfoDrawer)
window.Vue.component('show-one-task', ShowOneTask)
// Changelog
window.Vue.component('changelog', Changelog)
window.Vue.component('notifications-widget', NotificationsWidget)
window.Vue.component('notifications', Notifications)
// Images
window.Vue.component('img-webp', ImgWebp)
window.Vue.component('v-parallax-webp', VParallaxWebp)
// Mobile
window.Vue.component('vibrate', Vibrate)
window.Vue.component('battery-status', BatteryStatus)
window.Vue.component('memory', Memory)
window.Vue.component('online-state', OnlineState)
window.Vue.component('network-type-speed', NetworkTypeSpeed)
window.Vue.component('device-position', DevicePosition)
window.Vue.component('geolocation', Geolocation)

window.Vue.component('newsletter-subscription-card', NewsLetterSubscriptionCard)
window.Vue.component('newsletters', Newsletters)
window.Vue.component('clock', Clock)
window.Vue.component('chat', Chat)
window.Vue.component('users-list', UsersList)
window.Vue.component('gamepad-stick-simple', GamepadStickSimple)

// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)
