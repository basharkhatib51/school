const mutations = {
  SET_NOTIFICATIONS_DATA(state, value) {
    state.notifications = value
  },
  SET_SUBJECTS_DATA(state, value) {
    state.subjects = value
  },
  SET_RESULTS_DATA(state, value) {
    state.results = value
  },
  SET_PROGRAMS_DATA(state, value) {
    state.programs = value
  },
  SET_LAST_YEARS(state, value) {
    state.last_years = value
  },
  SET_MESSAGES_DATA(state, value) {
    state.messages = value
  },
  PUSH_MESSAGE(state, value) {
    state.messages.push(value)
  },
}
export default mutations
