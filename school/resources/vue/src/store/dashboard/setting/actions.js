import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`settings/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.setting)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('settings').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.settings)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('settings/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.settings)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`settings/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('settings', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`settings/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`settings/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
