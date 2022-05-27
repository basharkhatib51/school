import Vue from 'vue'

const actions = {

  GetAdmin({ commit }, admin) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`admins/${admin}`).then(response => {
        commit('GET_ADMIN_DATA', response.data.admin)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetAdmins({ commit }) {
    Vue.prototype.$http.get('admins').then(response => {
      commit('GET_ADMINS_DATA', response.data.admins)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('admins/trashed').then(response => {
      commit('GET_TRASHED_ADMINS_DATA', response.data.admins)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`admins/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('admins', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`admins/${payload}`).then(() => {
      dispatch('GetAdmins')
    })
  },
  ChangePassword({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`admins/change_password/${payload.id}`, payload.password).then(response => {
        dispatch('GetAdmins')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ChangeStatus({ dispatch }, admin) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`admins/change_status/${admin.id}`, admin).then(response => {
        dispatch('GetAdmins')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ChangeRole({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`admins/change_role/${payload.admin}`, payload).then(response => {
        dispatch('GetAdmins')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Restore({ dispatch }, admin) {
    Vue.prototype.$http.put(`admins/restore/${admin}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
