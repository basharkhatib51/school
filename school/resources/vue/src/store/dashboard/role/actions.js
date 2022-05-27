// import axios from 'axios'
import Vue from 'vue'

const actions = {
  GetRole({ commit }, user) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`role/${user}`).then(response => {
        commit('GET_ROLE_DATA', response.data.role)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetRoles({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('role').then(response => {
        commit('GET_ROLES_DATA', response.data.roles)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetPermissions({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('permissions').then(response => {
        commit('GET_PERMISSIONS_DATA', response.data.permissions)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, role) {
    Vue.prototype.$http.delete(`role/${role}`).then(() => {
      dispatch('GetRoles')
    })
  },
  Create({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('role', payload).then(response => {
        dispatch('GetRoles')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Update({ dispatch }, role) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`role/${role.id}`, role).then(response => {
        dispatch('GetRoles')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
}
export default actions
