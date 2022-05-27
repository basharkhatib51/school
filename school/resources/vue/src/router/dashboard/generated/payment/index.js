export default [
  {
    path: 'payment',
    name: 'payment',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'payment.list',
        meta: {
          permission: ['Payment List', 'Payment List Owner'],
        },
        component: () => import('@/views/dashboard/generated/payment/list.vue'),
      },
      {
        path: 'create',
        name: 'payment.create',
        meta: {
          permission: 'Create Payment',
        },
        component: () => import('@/views/dashboard/generated/payment/create.vue'),
      },
      {
        path: 'edit/:payment',
        name: 'payment.edit',
        meta: {
          permission: ['Update Payment', 'Update Payment Owner'],
        },
        component: () => import('@/views/dashboard/generated/payment/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'payment.trashed',
        meta: {
          permission: ['Show Payment Trash', 'Show Payment Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/payment/trashed.vue'),
      },
    ],
  },
]
