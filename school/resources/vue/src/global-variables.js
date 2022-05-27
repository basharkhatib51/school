import Vue from 'vue'
import store from '@/store'
import axios from '@/libs/axios'
import i18n from '@/libs/i18n'

Vue.prototype.$http = axios
Vue.prototype.$trans = i18n
Vue.prototype.$store = store
function fullPath() {
  if (window.location.hostname === 'localhost') return 'http://localhost:8000'
  return `${window.location.origin}`
}
Vue.prototype.$fullPath = fullPath()

const QuillUpload = {
  install() {
    Vue.prototype.quill_upload_axios = async (element = null) => new Promise(resolve => {
      let content = element
      let domain = ''
      if (element) {
        const Avatar = element.split('src="data:').pop().split('">')[0]
        if (Avatar.substring('0', '5') === 'image') {
          Vue.prototype.$http.post('upload/base64', { image: `data:${Avatar}` }).then(response => {
            if (window.location.hostname === 'localhost') { domain = Vue.prototype.$fullPath }
            content = element.replace(`data:${Avatar}`, domain + response.data.url)
            resolve(content)
          })
        }
      } else {
        resolve(content)
      }
    })
  },
}
// const AccessPlugin = {
//   install() {
//     Vue.prototype.have_access = (required = null, type = 'any') => {
//       if (store.getters['auth/isAuth'] === false) return false
//       const { role } = store.getters['auth/GetAuth']
//       if (role) if (role.name === 'SuperAdmin') return true
//       if (required === null) return false
//       let permissions = []
//       if (role) {
//         if (role.permissions) permissions = role.permissions.map(val => val.name)
//         else permissions = []
//       }
//       if (Array.isArray(required)) {
//         if (type === 'any' && required.some(e => permissions.includes(e))) return true
//         if (type === 'all' && required.every(e => permissions.includes(e))) return true
//       } else return permissions.includes(required)
//       return false
//     }
//     Vue.prototype.haveElementAccess = (required = null, createdById = null) => {
//       const auth = store.getters['auth/isAuth']
//       if (auth) if (auth.role) if (auth.role.name === 'SuperAdmin') return true
//       return (Vue.prototype.have_accesss(required) && auth.id === createdById)
//     }
//   },
// }
// Vue.use(AccessPlugin)
Vue.use(QuillUpload)
