import Vue from 'vue'

const actions = {

  GetStudent({ commit }, student) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`students/${student}`).then(response => {
        commit('GET_STUDENT_DATA', response.data.student)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetStudents({ commit }) {
    Vue.prototype.$http.get('students').then(response => {
      commit('GET_STUDENTS_DATA', response.data.students)
    })
  },
  GetTrashed({ commit }) {
    Vue.prototype.$http.get('students/trashed').then(response => {
      commit('GET_TRASHED_STUDENTS_DATA', response.data.students)
    })
  },
  Update(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`students/${payload.id}`, payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Create(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('students', payload).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Delete({ dispatch }, payload) {
    Vue.prototype.$http.delete(`students/${payload}`).then(() => {
      dispatch('GetStudents')
    })
  },
  ChangePassword({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`students/change_password/${payload.id}`, payload.password).then(response => {
        dispatch('GetStudents')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  ChangeStatus({ dispatch }, student) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`students/change_status/${student.id}`, student).then(response => {
        dispatch('GetStudents')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  Restore({ dispatch }, student) {
    Vue.prototype.$http.put(`students/restore/${student}`).then(() => {
      dispatch('GetTrashed')
    })
  },
}
export default actions
