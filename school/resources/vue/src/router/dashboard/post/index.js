export default [
  {
    path: 'post',
    name: 'post',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'post.list',
        meta: {
          permission: ['Post List', 'Post List Owner'],
        },
        component: () => import('@/views/dashboard/post/list.vue'),
      },
      {
        path: 'create',
        name: 'post.create',
        meta: {
          permission: 'Create Post',
        },
        component: () => import('@/views/dashboard/post/create.vue'),
      },
      {
        path: 'edit/:post',
        name: 'post.edit',
        meta: {
          permission: ['Update Post', 'Update Post Owner'],
        },
        component: () => import('@/views/dashboard/post/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'post.trashed',
        meta: {
          permission: ['Show Post Trash', 'Show Post Trash Owner'],
        },
        component: () => import('@/views/dashboard/post/trashed.vue'),
      },
    ],
  },
]
