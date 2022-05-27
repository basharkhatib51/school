export default [
  {
    path: 'class_level',
    name: 'class_level',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'class_level.list',
        meta: {
          permission: ['ClassLevel List', 'ClassLevel List Owner'],
        },
        component: () => import('@/views/dashboard/generated/class_level/list.vue'),
      },
      {
        path: 'create',
        name: 'class_level.create',
        meta: {
          permission: 'Create ClassLevel',
        },
        component: () => import('@/views/dashboard/generated/class_level/create.vue'),
      },
      {
        path: 'edit/:class_level',
        name: 'class_level.edit',
        meta: {
          permission: ['Update ClassLevel', 'Update ClassLevel Owner'],
        },
        component: () => import('@/views/dashboard/generated/class_level/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'class_level.trashed',
        meta: {
          permission: ['Show ClassLevel Trash', 'Show ClassLevel Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/class_level/trashed.vue'),
      },
    ],
  },
]
