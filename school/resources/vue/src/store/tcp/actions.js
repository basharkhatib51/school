import Vue from 'vue'

const actions = {
  GetPrograms({ commit }) {
    Vue.prototype.$http.get('tcp/programs').then(response => {
      commit('GET_PROGRAMS_DATA', response.data.programs)
    })
  },
  GetSubjectRegistrations({ commit }) {
    Vue.prototype.$http.get('tcp/subject_registrations').then(response => {
      commit('GET_SUBJECTS_DATA', response.data.subject_registrations)
    })
  },
  GetSubjectRegistration({ commit }, payload) {
    Vue.prototype.$http.get(`tcp/subject_registration/${payload}`).then(response => {
      commit('GET_SUBJECT_DATA', response.data.subject_registration)
    })
  },
  GetExam({ commit }, payload) {
    Vue.prototype.$http.get(`tcp/exam/${payload}`).then(response => {
      commit('GET_EXAM_DATA', response.data.exam)
    })
  },
  ChangeChatStatus({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.put(`tcp/change_chat_status/${payload}`).then(response => {
        dispatch('GetSubjectRegistrations')
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  CreateExam({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post('tcp/create_exam', payload).then(response => {
        dispatch('GetSubjectRegistration', payload.subject_registration)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  updateResult({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`tcp/update_result/${payload.exam_id}`, payload).then(response => {
        dispatch('GetExam', payload.exam_id)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  updateResults({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`tcp/update_results/${payload.exam_id}`, payload).then(response => {
        dispatch('GetExam', payload.exam_id)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  DeleteExam({ dispatch }, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.delete(`tcp/delete_exam/${payload.exam_id}`).then(response => {
        dispatch('GetSubjectRegistration', payload.subject_registration_id)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  SendMessage(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`tcp/send_message/${payload.subject_registration}`, payload, { loading: false }).then(response => {
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
      Vue.prototype.$http.get(`tcp/messages/${payload}`).then(response => {
        commit('SET_MESSAGES_DATA', response.data.messages)
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  SendFileMessage(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.post(`tcp/send_file_message/${payload.subject_registration}`, payload, { loading: false }).then(response => {
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
