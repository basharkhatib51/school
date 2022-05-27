import Vue from 'vue'

// axios
import axios from 'axios'
import router from '@/router'
import store from '../store'

let RequestCount = 0
let domain = `${window.location.origin}`
if (window.location.host === 'localhost:8080') domain = 'http://localhost:8000'
const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  baseURL: `${domain}/api`,
  loading: true,
  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
})
axiosIns.defaults.withCredentials = true

Vue.prototype.$http = axiosIns

axiosIns.interceptors.request.use(config => {
  const axiosInsConfig = config
  axiosInsConfig.headers.common.Accept = `application/json; charset=utf-8; boundary=${Math.random().toString().substr(2)}`
  if (localStorage.getItem('token') && localStorage.getItem('user')) {
    axiosInsConfig.headers.common.Authorization = `Bearer ${localStorage.getItem('token')}`
  }
  if (config.loading) {
    RequestCount += 1
    const appLoading = document.getElementById('loading-bg')
    appLoading.style.display = 'block'
    store.dispatch('app/update_loading', true).then()
  }
  axiosInsConfig.headers.common.LOCAL = Vue.prototype.$trans.locale
  return config
}, error => Promise.reject(error))

axiosIns.interceptors.response.use(response => {
  if (RequestCount > 0) RequestCount -= 1
  if (RequestCount === 0) {
    store.dispatch('app/update_loading', false).then()
    const appLoading = document.getElementById('loading-bg')
    if (appLoading && !store.state.app.loading) {
      appLoading.style.display = 'none'
    }
  }
  if (response.data.message) {
    Vue.prototype.$swal({
      icon: 'success',
      title: Vue.prototype.$trans.t('Success'),
      text: Vue.prototype.$trans.t(response.data.message),
      showConfirmButton: false,
      allowOutsideClick: true,
    })
  }

  return response
}, error => {
  if (RequestCount > 0) RequestCount -= 1
  if (RequestCount === 0) store.dispatch('app/update_loading', false).then()
  let MessageError
  if (error.response.data) {
    if (error.response.data.message) MessageError = error.response.data.message
  } else MessageError = Vue.prototype.$trans.t('Unexpected Error')

  if (error.response.status === 422) {
    Vue.prototype.$swal({
      icon: 'error',
      title: Vue.prototype.$trans.t('Error!'),
      text: Vue.prototype.$trans.t(MessageError),
      showConfirmButton: false,
      allowOutsideClick: true,
    })
  } else if (error.response.status === 400) {
    router.push({
      name: 'error-404',
    }).then()
  } else if (error.response.status === 403) {
    router.push({
      name: 'error-403',
    }).then()
  } else if (error.response.status === 401) {
    if (error.config.url !== 'authorize/logout') store.dispatch('auth/Logout', true).then()
    else {
      localStorage.removeItem('user')
      localStorage.removeItem('token')
      localStorage.removeItem('isAuth')
    }
  } else if (error.response.status === 404) {
    router.push({
      name: 'error-404',
    }).then()
  } else if (error.response.status === 405) {
    router.push({
      name: 'error-403',
    }).then()
  } else if (error.response.status === 500) {
    Vue.prototype.$swal({
      icon: 'error',
      title: Vue.prototype.$trans.t('Error!'),
      text: Vue.prototype.$trans.t(error.response.message),
      showConfirmButton: false,
      allowOutsideClick: true,
    })
    // router.push({
    //   name: 'error-500',
    // }).then()
  }
  if (RequestCount === 0) {
    const appLoading = document.getElementById('loading-bg')
    if (appLoading && !store.state.app.loading) {
      appLoading.style.display = 'none'
    }
  }
  return Promise.reject(error)
})
export default axiosIns
