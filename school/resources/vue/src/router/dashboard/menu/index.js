export default [
  {
    path: 'menu',
    name: 'menu',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'menu.list',
        meta: {
          permission: ['Menu List', 'Menu List Owner'],
        },
        component: () => import('@/views/dashboard/menu/list.vue'),
      },
      {
        path: 'create',
        name: 'menu.create',
        meta: {
          permission: 'Create Menu',
        },
        component: () => import('@/views/dashboard/menu/create.vue'),
      },
      {
        path: 'edit/:menu',
        name: 'menu.edit',
        meta: {
          permission: ['Update Menu', 'Update Menu Owner'],
        },
        component: () => import('@/views/dashboard/menu/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'menu.trashed',
        meta: {
          permission: ['Show Menu Trash', 'Show Menu Trash Owner'],
        },
        component: () => import('@/views/dashboard/menu/trashed.vue'),
      },
    ],
  },
]
