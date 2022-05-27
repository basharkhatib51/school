export default [
  {
    path: 'admin',
    name: 'admin',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'admin.list',
        meta: {
          permission: ['Admin List', 'Admin List Owner'],
        },
        component: () => import('@/views/dashboard/admin/list.vue'),
      },
      {
        path: 'trashed',
        name: 'admin.trashed',
        meta: {
          permission: ['Show Admin Trash', 'Show Admin Trash Owner'],
        },
        component: () => import('@/views/dashboard/admin/trashed.vue'),
      },
      {
        path: 'create',
        name: 'admin.create',
        meta: {
          permission: 'Create Admin',
        },
        component: () => import('@/views/dashboard/admin/create.vue'),
      },
      {
        path: 'edit/:admin',
        name: 'admin.edit',
        meta: {
          permission: ['Update Admin', 'Update Admin Owner'],
        },
        component: () => import('@/views/dashboard/admin/edit.vue'),
      },
    ],
  },
]
