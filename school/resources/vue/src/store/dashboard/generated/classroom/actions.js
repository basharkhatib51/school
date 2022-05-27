import Vue from 'vue'

const actions = {

  GetElement({ commit }, element) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`generated/classrooms/${element}`).then(response => {
        commit('GET_ELEMENT_DATA', response.data.classroom)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetElementsFilter({ commit }, payload) {
    Vue.prototype.$http.post('generated/classrooms/filter', payload).then(response => {
      commit('GET_ELEMENTS_DATA', response.data.classrooms)
    })
  },
  GetElements({ commit }) {
    Vue.prototype.$http.get('generated/classrooms').then(response => {
      commit('GET_ELEMENTS_DATA', response.data.classrooms)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('generated/classrooms/trashed').then(response => {
      commit('GET_TRASHED_DATA', response.data.classrooms)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`generated/classrooms/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('generated/classrooms', payload).then(response => {
        dispatch('classLevel/GetElement', payload.class_level, { root: true })
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.delete(`generated/classrooms/${payload.element}`).then(() => {
        dispatch('classLevel/GetElement', payload.class_level, { root: true })
      }).catch(error => {
        reject(error)
      })
    })
  },
  Restore({ dispatch }, element) {
    Vue.prototype.$http.put(`generated/classrooms/restore/${element}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
