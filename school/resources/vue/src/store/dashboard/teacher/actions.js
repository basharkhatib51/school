import Vue from 'vue'

const actions = {

  GetTeacher({ commit }, teacher) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`teachers/${teacher}`).then(response => {
        commit('GET_TEACHER_DATA', response.data.teacher)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetTeachers({ commit }) {
    Vue.prototype.$http.get('teachers').then(response => {
      commit('GET_TEACHERS_DATA', response.data.teachers)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('teachers/trashed').then(response => {
      commit('GET_TRASHED_TEACHERS_DATA', response.data.teachers)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`teachers/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('teachers', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`teachers/${payload}`).then(() => {
      dispatch('GetTeachers')
    })
  },
  ChangePassword({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`teachers/change_password/${payload.id}`, payload.password).then(response => {
        dispatch('GetTeachers')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ChangeStatus({ dispatch }, teacher) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`teachers/change_status/${teacher.id}`, teacher).then(response => {
        dispatch('GetTeachers')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Restore({ dispatch }, teacher) {
    Vue.prototype.$http.put(`teachers/restore/${teacher}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
