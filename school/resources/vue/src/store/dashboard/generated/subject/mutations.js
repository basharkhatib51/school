const mutations = {
  GET_ELEMENT_DATA(state, value) {
    state.element = value
  },
  GET_ELEMENTS_DATA(state, value) {
    state.elements = value
  },
  GET_TRASHED_DATA(state, value) {
    state.trashed = value
  },
}
export default mutations
