export default [
  {
    path: 'setting',
    name: 'setting',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'setting.list',
        meta: {
          permission: ['Setting List', 'Setting List Owner'],
        },
        component: () => import('@/views/dashboard/setting/list.vue'),
      },
      {
        path: 'create',
        name: 'setting.create',
        meta: {
          permission: 'Create Setting',
        },
        component: () => import('@/views/dashboard/setting/create.vue'),
      },
      {
        path: 'edit/:setting',
        name: 'setting.edit',
        meta: {
          permission: ['Update Setting', 'Update Setting Owner'],
        },
        component: () => import('@/views/dashboard/setting/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'setting.trashed',
        meta: {
          permission: ['Show Setting Trash', 'Show Setting Trash Owner'],
        },
        component: () => import('@/views/dashboard/setting/trashed.vue'),
      },
    ],
  },
]
