export default [
  {
    path: 'student',
    name: 'student',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'student.list',
        meta: {
          permission: ['Student List', 'Student List Owner'],
        },
        component: () => import('@/views/dashboard/student/list.vue'),
      },
      {
        path: 'trashed',
        name: 'student.trashed',
        meta: {
          permission: ['Show Student Trash', 'Show Student Trash Owner'],
        },
        component: () => import('@/views/dashboard/student/trashed.vue'),
      },
      {
        path: 'create',
        name: 'student.create',
        meta: {
          permission: 'Create Student',
        },
        component: () => import('@/views/dashboard/student/create.vue'),
      },
      {
        path: 'edit/:student',
        name: 'student.edit',
        meta: {
          permission: ['Update Student', 'Update Student Owner'],
        },
        component: () => import('@/views/dashboard/student/edit.vue'),
      },
    ],
  },
]
