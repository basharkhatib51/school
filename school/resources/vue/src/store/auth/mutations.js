const mutations = {
  UPDATE_USER_INFO_STATE(state, value) {
    state.isAuth = true
    state.user = JSON.parse(value)
  },
  UPDATE_USER_INFO(state, value) {
    localStorage.removeItem('user')
    localStorage.setItem('user', JSON.stringify(value))
    state.isAuth = true
    state.user = value
  },
  UPDATE_ACCESS_TOKEN(state, value) {
    localStorage.setItem('token', value)
    localStorage.setItem('isAuth', 'true')
    state.user = value
    state.isAuth = true
  },
  LOGOUT(state) {
    state.user = {}
    state.isAuth = false
    localStorage.removeItem('user')
    localStorage.removeItem('token')
    localStorage.removeItem('isAuth')
  },
}
export default mutations
