import Admin from './admin'
import Teacher from './teacher'
import Student from './student'
import Role from './role'
import Generated from './generated'
import Setting from './setting'
import Menu from './menu'
import Page from './page'
import Post from './post'
import Tag from './tag'

export default [
  ...Admin,
  ...Teacher,
  ...Student,
  ...Role,
  ...Setting,
  ...Menu,
  ...Page,
  ...Post,
  ...Tag,
  ...Generated,
  {
    path: 'dashboard',
    name: 'dashboard',
    component: () => import('@/views/dashboard/dashboard.vue'),
    meta: {
      layout: 'vertical',
    },
  },
  //   {
  //   path: 'settings',
  //   name: 'settings',
  //   component: () => import('@/views/dashboard/setting/setting.vue'),
  // },
]
