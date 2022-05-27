import { $themeBreakpoints } from '@themeConfig'

export default {
  namespaced: true,
  state: {
    appName: '',
    loading: false,
    windowWidth: 0,
    shallShowOverlay: false,
    bModal: [],
  },
  getters: {
    loading: state => state.loading,
    appName: state => state.appName,
    currentBreakPoint: state => {
      const { windowWidth } = state
      if (windowWidth >= $themeBreakpoints.xl) return 'xl'
      if (windowWidth >= $themeBreakpoints.lg) return 'lg'
      if (windowWidth >= $themeBreakpoints.md) return 'md'
      if (windowWidth >= $themeBreakpoints.sm) return 'sm'
      return 'xs'
    },
  },
  mutations: {
    UPDATE_LOADING(state, val) {
      state.loading = val
    },
    UPDATE_WINDOW_WIDTH(state, val) {
      state.windowWidth = val
    },
    TOGGLE_OVERLAY(state, val) {
      state.shallShowOverlay = val !== undefined ? val : !state.shallShowOverlay
    },
  },
  actions: {
    update_loading({ commit }, payload) {
      commit('UPDATE_LOADING', payload)
    },
  },
}
