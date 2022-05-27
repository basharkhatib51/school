export default [
  {
    path: 'dashboard',
    name: 'scp.dashboard',
    component: () => import('@/views/scp/dashboard.vue'),
    meta: {
      layout: 'student',
    },
  }, {
    path: 'results',
    name: 'scp.results',
    component: () => import('@/views/scp/results.vue'),
    meta: {
      layout: 'student',
    },
  }, {
    path: 'chat',
    name: 'scp.chat',
    component: () => import('@/views/scp/chat.vue'),
    meta: {
      layout: 'student',
      slider: 'null',
    },
  }, {
    path: 'program',
    name: 'scp.program',
    component: () => import('@/views/scp/program.vue'),
    meta: {
      layout: 'student',
    },
  }, {
    path: 'subjects',
    name: 'scp.subjects',
    component: () => import('@/views/scp/subjects.vue'),
    meta: {
      layout: 'student',
    },
  }, {
    path: 'last_years',
    name: 'scp.last_years',
    component: () => import('@/views/scp/last_years.vue'),
    meta: {
      layout: 'student',
    },
  },
]
