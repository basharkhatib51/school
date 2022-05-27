export default [
  {
    path: 'dashboard',
    name: 'tcp.dashboard',
    component: () => import('@/views/tcp/dashboard.vue'),
  },
  {
    path: 'program',
    name: 'tcp.program',
    component: () => import('@/views/tcp/program/program.vue'),
  },
  {
    path: 'subject_registration',
    name: 'tcp.subject_registration',
    component: () => import('@/views/tcp/subject/subject.vue'),
  },
  {
    path: 'subject-info/:subject_registration',
    name: 'tcp.subject-info',
    component: () => import('@/views/tcp/subject/subject_info.vue'),
  },
  {
    path: 'exam_results/:exam',
    name: 'tcp.exam_results',
    component: () => import('@/views/tcp/subject/exam_results.vue'),
  },
]
