export default [
  {
    path: '',
    component: { render: h => h('router-view') },
    meta: {
      layout: 'full',
    },
    children: [
      {
        path: '/error-404',
        name: 'error-404',
        component: () => import('@/views/error/Error404.vue'),
        meta: {
          layout: 'full',
        },
      }, {
        path: '/error-403',
        name: 'error-403',
        component: () => import('@/views/error/Error403.vue'),
        meta: {
          layout: 'full',
        },
      }, {
        path: '/error-500',
        name: 'error-500',
        component: () => import('@/views/error/Error500.vue'),
        meta: {
          layout: 'full',
        },
      }],
  },
]
