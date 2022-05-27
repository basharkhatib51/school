export default [
  {
    path: 'notification',
    name: 'notification',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'notification.list',
        meta: {
          permission: ['Notification List', 'Notification List Owner'],
        },
        component: () => import('@/views/dashboard/generated/notification/list.vue'),
      },
      {
        path: 'create',
        name: 'notification.create',
        meta: {
          permission: 'Create Notification',
        },
        component: () => import('@/views/dashboard/generated/notification/create.vue'),
      },
      // {
      //   path: 'edit/:notification',
      //   name: 'notification.edit',
      //   meta: {
      //     permission: ['Update Notification', 'Update Notification Owner'],
      //   },
      //   component: () => import('@/views/dashboard/generated/notification/edit.vue'),
      // },
      {
        path: 'trashed',
        name: 'notification.trashed',
        meta: {
          permission: ['Show Notification Trash', 'Show Notification Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/notification/trashed.vue'),
      },
    ],
  },
]
