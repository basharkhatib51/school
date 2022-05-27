const mutations = {
  GET_ADMIN_DATA(state, value) {
    state.admin = value
  },
  GET_ADMINS_DATA(state, value) {
    state.admins = value
  },
  GET_TRASHED_ADMINS_DATA(state, value) {
    state.trashed_admins = value
  },
}
export default mutations
