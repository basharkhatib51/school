export default [
  {
    path: 'program',
    name: 'program',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'program.list',
        meta: {
          permission: ['Program List', 'Program List Owner'],
        },
        component: () => import('@/views/dashboard/generated/program/list.vue'),
      },
      {
        path: 'create',
        name: 'program.create',
        meta: {
          permission: 'Create Program',
        },
        component: () => import('@/views/dashboard/generated/program/create.vue'),
      },
    ],
  },
]
