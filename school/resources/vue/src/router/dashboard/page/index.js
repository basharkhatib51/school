export default [
  {
    path: 'page',
    name: 'page',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'page.list',
        meta: {
          permission: ['Page List', 'Page List Owner'],
        },
        component: () => import('@/views/dashboard/page/list.vue'),
      },
      {
        path: 'create',
        name: 'page.create',
        meta: {
          permission: 'Create Page',
        },
        component: () => import('@/views/dashboard/page/create.vue'),
      },
      {
        path: 'edit/:page',
        name: 'page.edit',
        meta: {
          permission: ['Update Page', 'Update Page Owner'],
        },
        component: () => import('@/views/dashboard/page/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'page.trashed',
        meta: {
          permission: ['Show Page Trash', 'Show Page Trash Owner'],
        },
        component: () => import('@/views/dashboard/page/trashed.vue'),
      },
    ],
  },
]
