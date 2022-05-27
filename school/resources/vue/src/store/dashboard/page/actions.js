import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`pages/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.page)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('pages').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.pages)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('pages/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.pages)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`pages/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('pages', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`pages/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`pages/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
