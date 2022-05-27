export default [
  {
    path: 'classroom',
    name: 'classroom',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'classroom.list',
        meta: {
          permission: ['Classroom List', 'Classroom List Owner'],
        },
        component: () => import('@/views/dashboard/generated/classroom/list.vue'),
      },
      {
        path: 'create',
        name: 'classroom.create',
        meta: {
          permission: 'Create Classroom',
        },
        component: () => import('@/views/dashboard/generated/classroom/create.vue'),
      },
      {
        path: 'edit/:classroom',
        name: 'classroom.edit',
        meta: {
          permission: ['Update Classroom', 'Update Classroom Owner'],
        },
        component: () => import('@/views/dashboard/generated/classroom/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'classroom.trashed',
        meta: {
          permission: ['Show Classroom Trash', 'Show Classroom Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/classroom/trashed.vue'),
      },
    ],
  },
]
