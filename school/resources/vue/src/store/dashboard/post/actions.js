import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`posts/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.post)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('posts').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.posts)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('posts/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.posts)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`posts/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('posts', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`posts/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`posts/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
