export default [

  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/auth/Login.vue'),
    meta: {
      layout: 'full',
    },
    beforeEnter(to, _, next) {
      if (localStorage.getItem('isAuth')) {
        next({ name: 'dashboard' })
      } else {
        next()// not auth
      }
    },
  },
  // {
  //   path: '/authorize/:provider/callback',
  //   name: 'authorize-provider-callback',
  //   component: () => import('@/views/auth/AuthorizeProviderCallback.vue'),
  //   meta: {
  //     layout: 'full',
  //   },
  //   beforeEnter(to, _, next) {
  //     if (localStorage.getItem('isAuth')) {
  //       next({ name: 'dashboard' })
  //     } else {
  //       next()// not auth
  //     }
  //   },
  // },
  // {
  //   path: '/forget-password',
  //   name: 'forget-password',
  //   component: () => import('@/views/auth/ForgetPassword.vue'),
  //   meta: {
  //     layout: 'full',
  //   },
  // },
  // {
  //   path: '/reset-password/:email/:link',
  //   name: 'reset-password',
  //   component: () => import('@/views/auth/ResetPassword.vue'),
  //   meta: {
  //     layout: 'full',
  //   },
  // },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('@/views/auth/profile.vue'),
    meta: {
      layout: 'home',
    },
  },

]
