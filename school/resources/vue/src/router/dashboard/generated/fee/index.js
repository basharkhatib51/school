export default [
  {
    path: 'fee',
    name: 'fee',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'fee.list',
        meta: {
          permission: ['Fee List', 'Fee List Owner'],
        },
        component: () => import('@/views/dashboard/generated/fee/list.vue'),
      },
      {
        path: 'create',
        name: 'fee.create',
        meta: {
          permission: 'Create Fee',
        },
        component: () => import('@/views/dashboard/generated/fee/create.vue'),
      },
      {
        path: 'edit/:fee',
        name: 'fee.edit',
        meta: {
          permission: ['Update Fee', 'Update Fee Owner'],
        },
        component: () => import('@/views/dashboard/generated/fee/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'fee.trashed',
        meta: {
          permission: ['Show Fee Trash', 'Show Fee Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/fee/trashed.vue'),
      },
    ],
  },
]
