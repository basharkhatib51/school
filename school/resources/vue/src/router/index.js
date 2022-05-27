import Vue from 'vue'
import VueRouter from 'vue-router'
import mixin from '@/mixin'
import Auth from './auth'
import Home from './home'
import Error from './error'
import Dashboard from './dashboard'
import Teacher from './teacher'
import Student from './student'
import Family from './family'
// ? For splash screen
// Remove afterEach hook if you are not using splash screen

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    ...Home,
    ...Auth,
    ...Error,
    {
      path: '/acp',
      component: { render: h => h('router-view') },
      meta: {
        authRequired: 'true',
        authType: 'admin',
        layout: 'vertical',
      },
      children: [
        ...Dashboard,
      ],
    },
    {
      name: 'tcp',
      path: '/tcp',
      component: { render: h => h('router-view') },
      meta: {
        authRequired: 'true',
        authType: 'teacher',
        layout: 'vertical',
      },
      children: [
        ...Teacher,
      ],
    },

    {
      name: 'scp',
      path: '/scp',
      component: { render: h => h('router-view') },
      meta: {
        authRequired: 'true',
        authType: 'student',
        layout: 'student',
      },
      children: [
        ...Student,
      ],
    },
    {
      name: 'fcp',
      path: '/fcp',
      component: { render: h => h('router-view') },
      meta: {
        authRequired: 'true',
        authType: 'family',
      },
      children: [
        ...Family,
      ],
    },
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.authRequired)) {
    if (localStorage.getItem('isAuth')) {
      if (!mixin.methods.haveRootUserType(to.matched[0].meta.authType)) return next({ name: 'error-404' })
      if (to.meta.permission) {
        let type = 'any'
        if (to.meta.type)type = to.meta.type
        if (mixin.methods.haveRouteAccess(to.meta.permission, type)) {
          return next()
        }
        return next({ name: 'error-403' })
      }
      return next()
    }
    return next({ name: 'login' })
  }
  return next()
})
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading && !Vue.prototype.$store.state.app.loading) {
    appLoading.style.display = 'none'
  }
})

export default router
