import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`tags/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.tag)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('tags').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.tags)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('tags/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.tags)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`tags/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('tags', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`tags/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`tags/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
