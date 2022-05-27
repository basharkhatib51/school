export default [
  {
    path: 'dashboard',
    name: 'fcp.dashboard',
    component: () => import('@/views/fcp/dashboard.vue'),
    meta: {
      layout: 'home',
    },
  },
]
