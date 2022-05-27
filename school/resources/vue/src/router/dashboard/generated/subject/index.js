export default [
  {
    path: 'subject',
    name: 'subject',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'subject.list',
        meta: {
          permission: ['Subject List', 'Subject List Owner'],
        },
        component: () => import('@/views/dashboard/generated/subject/list.vue'),
      },
      {
        path: 'create',
        name: 'subject.create',
        meta: {
          permission: 'Create Subject',
        },
        component: () => import('@/views/dashboard/generated/subject/create.vue'),
      },
      {
        path: 'edit/:subject',
        name: 'subject.edit',
        meta: {
          permission: ['Update Subject', 'Update Subject Owner'],
        },
        component: () => import('@/views/dashboard/generated/subject/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'subject.trashed',
        meta: {
          permission: ['Show Subject Trash', 'Show Subject Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/subject/trashed.vue'),
      },
    ],
  },
]
