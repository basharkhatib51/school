export default [
  {
    path: 'message',
    name: 'message',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'message.list',
        meta: {
          permission: ['Message List', 'Message List Owner'],
        },
        component: () => import('@/views/dashboard/generated/message/list.vue'),
      },
      {
        path: 'create',
        name: 'message.create',
        meta: {
          permission: 'Create Message',
        },
        component: () => import('@/views/dashboard/generated/message/create.vue'),
      },
      {
        path: 'edit/:message',
        name: 'message.edit',
        meta: {
          permission: ['Update Message', 'Update Message Owner'],
        },
        component: () => import('@/views/dashboard/generated/message/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'message.trashed',
        meta: {
          permission: ['Show Message Trash', 'Show Message Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/message/trashed.vue'),
      },
    ],
  },
]
