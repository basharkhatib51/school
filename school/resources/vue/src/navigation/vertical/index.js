// import generated from '../generated/index'
import admin from './admin'
import student from './student'
import teacher from './teacher'
import family from './family'

export default [
  {
    title: 'Home',
    route: 'home',
    icon: 'home',
    pack: 'fas',
  },
  ...admin,
  ...teacher,
  ...student,
  ...family,
]
