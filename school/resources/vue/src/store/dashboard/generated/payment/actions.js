import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/payments/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.payment)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/payments').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.payments)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/payments/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.payments)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/payments/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/payments', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`generated/payments/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/payments/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
