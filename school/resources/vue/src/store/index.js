import Vue from 'vue'
import Vuex from 'vuex'

// Modules
import app from './app'
import appConfig from './app-config'
import verticalMenu from './vertical-menu'
import auth from './auth'
import upload from './upload'
import dashboard from './dashboard'
import home from './home'
import tcp from './tcp'
import scp from './scp'

Vue.use(Vuex)

export default new Vuex.Store({
  namespaced: true,
  modules: {
    namespaced: true,
    app,
    home,
    appConfig,
    verticalMenu,
    auth,
    tcp,
    scp,
    upload,
    dashboard,
  },
  strict: process.env.DEV,
})
