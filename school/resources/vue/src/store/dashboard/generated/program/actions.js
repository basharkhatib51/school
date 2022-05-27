import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/programs/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.program)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/programs').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.programs)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/programs/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.programs)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/programs/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/programs', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.delete(`generated/programs/${payload}`).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/programs/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
