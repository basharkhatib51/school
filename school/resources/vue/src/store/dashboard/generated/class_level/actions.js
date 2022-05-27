import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/class_levels/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.class_level)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/class_levels').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.class_levels)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/class_levels/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.class_levels)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/class_levels/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/class_levels', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`generated/class_levels/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/class_levels/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions