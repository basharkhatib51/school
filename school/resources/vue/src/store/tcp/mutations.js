const mutations = {
  GET_PROGRAMS_DATA(state, value) {
    state.programs = value
  },
  GET_SUBJECT_DATA(state, value) {
    state.subject_registration = value
  },
  GET_SUBJECTS_DATA(state, value) {
    state.subject_registrations = value
  },
  SET_MESSAGES_DATA(state, value) {
    state.messages = value
  },
  GET_EXAM_DATA(state, value) {
    state.exam = value
  },
  PUSH_MESSAGE(state, value) {
    state.messages.push(value)
  },
}
export default mutations
