import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/fees/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.fee)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/fees').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.fees)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/fees/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.fees)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/fees/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/fees', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`generated/fees/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/fees/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
