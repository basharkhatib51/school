import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/subjects/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.subject)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElementsFilter({ commit }, payload) {
    Vue.prototype.$http.post('generated/subjects/filter', payload).then(response => {
      commit('GET_ELEMENTS_DATA', response.data.subjects)
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/subjects').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.subjects)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/subjects/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.subjects)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/subjects/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/subjects', payload).then(response => {
        dispatch('classLevel/GetElement', payload.class_level, { root: true })
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`generated/subjects/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/subjects/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
