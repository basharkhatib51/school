export default [
  {
    path: 'tag',
    name: 'tag',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'tag.list',
        meta: {
          permission: ['Tag List', 'Tag List Owner'],
        },
        component: () => import('@/views/dashboard/tag/list.vue'),
      },
      {
        path: 'create',
        name: 'tag.create',
        meta: {
          permission: 'Create Tag',
        },
        component: () => import('@/views/dashboard/tag/create.vue'),
      },
      {
        path: 'edit/:tag',
        name: 'tag.edit',
        meta: {
          permission: ['Update Tag', 'Update Tag Owner'],
        },
        component: () => import('@/views/dashboard/tag/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'tag.trashed',
        meta: {
          permission: ['Show Tag Trash', 'Show Tag Trash Owner'],
        },
        component: () => import('@/views/dashboard/tag/trashed.vue'),
      },
    ],
  },
]
