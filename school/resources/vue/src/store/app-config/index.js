import { $themeConfig } from '@themeConfig'

function getDir(val) {
  if (localStorage.getItem('isRTL') === 'true') return true
  if (localStorage.getItem('isRTL') === 'false') return false
  return val
}
export default {
  namespaced: true,
  state: {
    layout: {
      isRTL: getDir($themeConfig.layout.isRTL),
      skin: localStorage.getItem('skin') || $themeConfig.layout.skin,
      routerTransition: $themeConfig.layout.routerTransition,
      type: $themeConfig.layout.type,
      contentWidth: $themeConfig.layout.contentWidth,
      menu: {
        hidden: $themeConfig.layout.menu.hidden,
      },
      navbar: {
        type: $themeConfig.layout.navbar.type,
        backgroundColor: $themeConfig.layout.navbar.backgroundColor,
      },
      footer: {
        type: $themeConfig.layout.footer.type,
      },
    },
  },
  getters: {},
  mutations: {
    // UPDATE_RTL(state, payload) {

    // },
    TOGGLE_RTL(state, payload) {
      state.layout.isRTL = payload
      localStorage.setItem('isRTL', payload)
      document.documentElement.setAttribute('dir', state.layout.isRTL ? 'rtl' : 'ltr')
    },
    UPDATE_SKIN(state, skin) {
      state.layout.skin = skin

      // Update value in localStorage
      localStorage.setItem('skin', skin)

      // Update DOM for dark-layout
      if (skin === 'dark') document.body.classList.add('dark-layout')
      else if (document.body.className.match('dark-layout')) document.body.classList.remove('dark-layout')
    },
    UPDATE_ROUTER_TRANSITION(state, val) {
      state.layout.routerTransition = val
    },
    UPDATE_LAYOUT_TYPE(state, val) {
      state.layout.type = val
    },
    UPDATE_CONTENT_WIDTH(state, val) {
      state.layout.contentWidth = val
    },
    UPDATE_NAV_MENU_HIDDEN(state, val) {
      state.layout.menu.hidden = val
    },
    UPDATE_NAVBAR_CONFIG(state, obj) {
      Object.assign(state.layout.navbar, obj)
    },
    UPDATE_FOOTER_CONFIG(state, obj) {
      Object.assign(state.layout.footer, obj)
    },
  },
  actions: {},
}