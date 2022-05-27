export default [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/home/Home.vue'),
    meta: {
      layout: 'home',
      slider: true,
    },
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('@/views/home/About.vue'),
    meta: {
      layout: 'home',
    },
  },
  {
    path: '/policy',
    name: 'policy',
    component: () => import('@/views/home/Policy.vue'),
    meta: {
      layout: 'home',
    },
  },
  {
    path: '/contact-us',
    name: 'contact',
    component: () => import('@/views/home/ContactUs.vue'),
    meta: {
      layout: 'home',
    },
  },
  {
    path: '/posts',
    name: 'posts',
    component: () => import('@/views/home/posts.vue'),
    meta: {
      layout: 'home',
    },
  },
  {
    path: '/page/:page',
    name: 'page',
    component: () => import('@/views/home/Page.vue'),
    meta: {
      layout: 'home',
      slider: true,
    },
  },
  {
    path: '/teacher',
    name: 'teacher',
    component: () => import('@/views/home/Teacher.vue'),
    meta: {
      layout: 'home',
    },
  },
]
