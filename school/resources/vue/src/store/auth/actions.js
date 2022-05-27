// import axios from 'axios'
import Vue from 'vue'
import router from '@/router'

const actions = {

  Login({ commit }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/login', payload).then(response => {
        if (response.data.token && response.data.user) {
          commit('UPDATE_ACCESS_TOKEN', response.data.token)
          commit('UPDATE_USER_INFO', response.data.user)
        }
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Logout({ commit }) {
    if (localStorage.getItem('token')) {
      Vue.prototype.$http.post('authorize/logout').then(() => {
        commit('LOGOUT', {})
        router.push({
          name: 'login',
        })
      }).catch(() => {
        localStorage.removeItem('user')
        localStorage.removeItem('token')
        localStorage.removeItem('isAuth')
        commit('LOGOUT', {})
        router.push({
          name: 'login',
        })
      })
    } else {
      localStorage.removeItem('user')
      localStorage.removeItem('token')
      localStorage.removeItem('isAuth')
    }
  },
  UpdateProfile({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/update_profile', payload).then(response => {
        dispatch('UpdateAuth')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ChangePassword({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/change_password', payload.password).then(response => {
        dispatch('UpdateAuth')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ForgetPassword(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/forget_password', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ResetPassword(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/reset_password', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  CheckCode(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('authorize/check_code', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  UpdateAuth({ commit, dispatch }) {
    commit('UPDATE_USER_INFO_STATE', localStorage.getItem('user'))
    Vue.prototype.$http.post('authorize/get_auth').then(response => {
      commit('UPDATE_USER_INFO', response.data.user)
    }).catch(() => {
      dispatch('Logout')
    })
  },
  SocialLoginAction(_, provider) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`authorize/${provider}/redirect`).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  SocialLoginCallback({ commit }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`authorize/${payload.provider}/callback`, {
        params: {
          code: payload.token,
        },
      }).then(response => {
        commit('UPDATE_ACCESS_TOKEN', response.data.token)
        commit('UPDATE_USER_INFO', response.data.user)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
}
export default actions
