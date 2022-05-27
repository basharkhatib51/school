const mutations = {
  GET_TEACHER_DATA(state, value) {
    state.teacher = value
  },
  GET_TEACHERS_DATA(state, value) {
    state.teachers = value
  },
  GET_TRASHED_TEACHERS_DATA(state, value) {
    state.trashed_teachers = value
  },
}
export default mutations
