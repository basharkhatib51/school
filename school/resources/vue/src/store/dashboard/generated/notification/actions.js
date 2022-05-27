import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/notifications/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.notification)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/notifications').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.notifications)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/notifications/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.notifications)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/notifications/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/notifications', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`generated/notifications/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/notifications/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
