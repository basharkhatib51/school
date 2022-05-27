import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/subject_registrations/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/subject_registrations').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.subject_registrations)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/subject_registrations/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.subject_registrations)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/subject_registrations/${payload.subject_registration}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/subject_registrations', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.delete(`generated/subject_registrations/${payload}`).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/subject_registrations/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
