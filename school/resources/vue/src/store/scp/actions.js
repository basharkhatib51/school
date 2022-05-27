import Vue from 'vue'

const actions = {
  SendMessage(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`scp/send_message/${payload.subject_registration}`, payload, { loading: false }).then(response => {
        // dispatch('GetMessages', payload.subject_registration).then(() => {
        resolve(response)
        // })
      }).catch(error => {
        reject(error)
      })
    })
  },

  pushMsg({ commit }, payload) {
    commit('PUSH_MESSAGE', payload.message)
  },
  GetMessages({ commit }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`scp/messages/${payload}`).then(response => {
        commit('SET_MESSAGES_DATA', response.data.messages)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetLastYears({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('scp/last_years').then(response => {
        commit('SET_LAST_YEARS', response.data.last_years)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetLastYearsFamily({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('fcp/last_years').then(response => {
        commit('SET_LAST_YEARS', response.data.last_years)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetStudentProgram({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('scp/student_program').then(response => {
        commit('SET_PROGRAMS_DATA', response.data.programs)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetStudentResults({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('scp/student_result').then(response => {
        commit('SET_RESULTS_DATA', response.data.results)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetStudentSubjects({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('scp/student_subject').then(response => {
        commit('SET_SUBJECTS_DATA', response.data.subjects)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  GetNotifications({ commit }) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get('scp/notifications').then(response => {
        commit('SET_NOTIFICATIONS_DATA', response.data.notifications)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  SendFileMessage(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`scp/send_file_message/${payload.subject_registration}`, payload, { loading: false }).then(response => {
        // dispatch('GetMessages', payload.subject_registration).then(() => {
        resolve(response)
        // })
      }).catch(error => {
        reject(error)
      })
    })
  },
}
export default actions
