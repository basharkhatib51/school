import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/student_registrations/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.student_registration)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/student_registrations').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.student_registrations)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/student_registrations/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.student_registrations)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/student_registrations/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/student_registrations', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`generated/student_registrations/${payload}`).then(() => {
      dispatch('GetElements')
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/student_registrations/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
