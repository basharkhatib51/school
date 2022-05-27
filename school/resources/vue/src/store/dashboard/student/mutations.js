const mutations = {
  GET_STUDENT_DATA(state, value) {
    state.student = value
  },
  GET_STUDENTS_DATA(state, value) {
    state.students = value
  },
  GET_TRASHED_STUDENTS_DATA(state, value) {
    state.trashed_students = value
  },
}
export default mutations
