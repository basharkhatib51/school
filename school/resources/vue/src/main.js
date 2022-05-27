import Vue from 'vue'
import {
  BootstrapVue, IconsPlugin, ToastPlugin, ModalPlugin,
} from 'bootstrap-vue'
import VueCompositionAPI from '@vue/composition-api'
import AOS from 'aos'
import VueI18n from 'vue-i18n'
import i18n from '@/libs/i18n'
import mixin from '@/mixin'
import store from './store'
import router from './router'
import App from './App.vue'
// import firebase from '@/libs/firebase'
import firebaseMessaging from '@/libs/firebase'

// Global Components
import './global-components'
// Global Variables
import './global-variables'

// 3rd party plugins
import '@/libs/portal-vue'
import '@/libs/toastification'
import '@/libs/sweet-alerts'

import 'vue-toastification/dist/index.css'

import '@core/scss/vue/libs/vue-sweetalert.scss'
import '@core/scss/vue/libs/quill.scss'
import '@core/scss/vue/libs/toastification.scss'
import '@core/scss/base/pages/app-chat-list.scss'
import 'aos/dist/aos.css'

Vue.prototype.$messaging = firebaseMessaging
// BSV Plugin Registration
localStorage.setItem('isRTL', 'true')
localStorage.setItem('locale', 'ar')
// localStorage.setItem('token', '2|4aupG1K35cV42BdwSdly6K5DspQ0bwqNXh15sfBH')
// localStorage.setItem('isAuth', 'true')
Vue.use(ToastPlugin)
Vue.use(ModalPlugin)

Vue.use(BootstrapVue)
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueI18n)
// Composition API
Vue.use(VueCompositionAPI)

// import core styles
require('@core/scss/core.scss')

// import assets styles
require('@/assets/scss/style.scss')
require('@/assets/scss/home/style.scss')

Vue.config.productionTip = true
if (localStorage.getItem('user') === 'undefined' || localStorage.getItem('token') === 'undefined' || localStorage.getItem('isAuth') === 'undefined') {
  localStorage.removeItem('user')
  localStorage.removeItem('token')
  localStorage.removeItem('isAuth')
} else if (localStorage.getItem('isAuth')) store.dispatch('auth/UpdateAuth').then()
Vue.mixin(mixin)
new Vue({
  mounted() {
    AOS.init({
      delay: 500, // values from 0 to 3000, with step 50ms
      duration: 1000, // values from 0 to 3000, with step 50ms
    })
  },
  router,
  store,
  i18n,
  render: h => h(App),
}).$mount('#app')
