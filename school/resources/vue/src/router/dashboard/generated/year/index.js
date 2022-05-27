export default [
  {
    path: 'year',
    name: 'year',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'year.list',
        meta: {
          permission: ['Year List', 'Year List Owner'],
        },
        component: () => import('@/views/dashboard/generated/year/list.vue'),
      },
      {
        path: 'create',
        name: 'year.create',
        meta: {
          permission: 'Create Year',
        },
        component: () => import('@/views/dashboard/generated/year/create.vue'),
      },
      {
        path: 'edit/:year',
        name: 'year.edit',
        meta: {
          permission: ['Update Year', 'Update Year Owner'],
        },
        component: () => import('@/views/dashboard/generated/year/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'year.trashed',
        meta: {
          permission: ['Show Year Trash', 'Show Year Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/year/trashed.vue'),
      },
    ],
  },
]
