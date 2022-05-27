export default [
  {
    path: 'student_registration',
    name: 'student_registration',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'student_registration.list',
        meta: {
          permission: ['StudentRegistration List', 'StudentRegistration List Owner'],
        },
        component: () => import('@/views/dashboard/generated/student_registration/list.vue'),
      },
      {
        path: 'create',
        name: 'student_registration.create',
        meta: {
          permission: 'Create StudentRegistration',
        },
        component: () => import('@/views/dashboard/generated/student_registration/create.vue'),
      },
      {
        path: 'edit/:student_registration',
        name: 'student_registration.edit',
        meta: {
          permission: ['Update StudentRegistration', 'Update StudentRegistration Owner'],
        },
        component: () => import('@/views/dashboard/generated/student_registration/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'student_registration.trashed',
        meta: {
          permission: ['Show StudentRegistration Trash', 'Show StudentRegistration Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/student_registration/trashed.vue'),
      },
    ],
  },
]
