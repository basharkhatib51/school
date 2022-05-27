import Vue from 'vue'

export default {
  namespaced: true,
  state: {
    posts: [],
    post: '',
    page: '',
    menu_elements: [],
  },
  getters: {
    posts: state => state.posts,
    post: state => state.post,
    page: state => state.page,
    menuElements: state => state.menu_elements,
  },
  mutations: {
    UPDATE_POSTS(state, val) {
      state.posts = val
    },
    UPDATE_POST(state, val) {
      state.post = val
    },
    UPDATE_PAGE(state, val) {
      state.page = val
    },
    UPDATE_MENU_ELEMENTS(state, val) {
      state.menu_elements = val
    },
  },
  actions: {
    getPosts({ commit }) {
      Vue.prototype.$http.get('home/posts').then(response => {
        commit('UPDATE_POSTS', response.data.posts)
      })
    },
    getPost({ commit }, payload) {
      Vue.prototype.$http.get(`home/post/${payload}`).then(response => {
        commit('UPDATE_POST', response.data.post)
      })
    },
    getPage({ commit }, payload) {
      Vue.prototype.$http.get(`home/page/${payload}`).then(response => {
        commit('UPDATE_PAGE', response.data.page)
      })
    },
    getMenuElements({ commit }) {
      Vue.prototype.$http.get('home/menu_elements').then(response => {
        commit('UPDATE_MENU_ELEMENTS', response.data.menu_elements)
      })
    },
  },
}
