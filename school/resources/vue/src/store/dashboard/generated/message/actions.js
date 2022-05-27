import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/messages/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.message)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/messages').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.messages)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/messages/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.messages)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/messages/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/messages', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`generated/messages/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/messages/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
