export default [
  {
    path: 'subject_registration',
    name: 'subject_registration',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'subject_registration.list',
        meta: {
          permission: ['SubjectRegistration List', 'SubjectRegistration List Owner'],
        },
        component: () => import('@/views/dashboard/generated/subject_registration/list.vue'),
      },
      {
        path: 'create',
        name: 'subject_registration.create',
        meta: {
          permission: 'Create SubjectRegistration',
        },
        component: () => import('@/views/dashboard/generated/subject_registration/create.vue'),
      },
      {
        path: 'edit/:subject_registration',
        name: 'subject_registration.edit',
        meta: {
          permission: ['Update SubjectRegistration', 'Update SubjectRegistration Owner'],
        },
        component: () => import('@/views/dashboard/generated/subject_registration/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'subject_registration.trashed',
        meta: {
          permission: ['Show SubjectRegistration Trash', 'Show SubjectRegistration Trash Owner'],
        },
        component: () => import('@/views/dashboard/generated/subject_registration/trashed.vue'),
      },
    ],
  },
]
