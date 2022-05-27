import SubjectRegistration from './subject_registration'
import StudentRegistration from './student_registration'
import Subject from './subject'
import ClassLevel from './class_level'
import Classroom from './classroom'
import Fee from './fee'
import Payment from './payment'
import Notification from './notification'
import Message from './message'
import Program from './program'
import Year from './year'

export default [
  ...SubjectRegistration,
  ...StudentRegistration,
  ...Subject,
  ...ClassLevel,
  ...Classroom,
  ...Fee,
  ...Payment,
  ...Notification,
  ...Message,
  ...Program,
  ...Year,
]
