export default [
  {
    path: 'teacher',
    name: 'teacher',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'teacher.list',
        meta: {
          permission: ['Teacher List', 'Teacher List Owner'],
        },
        component: () => import('@/views/dashboard/teacher/list.vue'),
      },
      {
        path: 'trashed',
        name: 'teacher.trashed',
        meta: {
          permission: ['Show Teacher Trash', 'Show Teacher Trash Owner'],
        },
        component: () => import('@/views/dashboard/teacher/trashed.vue'),
      },
      {
        path: 'create',
        name: 'teacher.create',
        meta: {
          permission: 'Create Teacher',
        },
        component: () => import('@/views/dashboard/teacher/create.vue'),
      },
      {
        path: 'edit/:teacher',
        name: 'teacher.edit',
        meta: {
          permission: ['Update Teacher', 'Update Teacher Owner'],
        },
        component: () => import('@/views/dashboard/teacher/edit.vue'),
      },
    ],
  },
]
