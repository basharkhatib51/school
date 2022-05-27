import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/years/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.year)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/years').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.years)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/years/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.years)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/years/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/years', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`generated/years/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/years/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
