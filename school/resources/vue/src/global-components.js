import Vue from 'vue'
import FeatherIcon from '@core/components/feather-icon/FeatherIcon.vue'

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'

import { fab } from '@fortawesome/free-brands-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { quillEditor } from 'vue-quill-editor'
import vSelect from 'vue-select'
import '@core/scss/vue/libs/vue-select.scss'
import Cleave from 'vue-cleave-component'
import VueSmoothScroll from 'vue2-smooth-scroll'
import VuePusher from 'vue-pusher'
import Upload from '@/layouts/components/Upload.vue'
import Explain from '@/views/dashboard/components/explain.vue'
import FileUpload from '@/layouts/components/FileUpload.vue'

VuePusher.logToConsole = false

Vue.use(VuePusher, {
  api_key: '54b51b93a330ffa74ee2',
  options: {
    cluster: 'eu',
    // encrypted: true,
  },
})
Vue.use(VueSmoothScroll)
library.add(fas)
library.add(fab)
library.add(far)
Vue.component('explain', Explain)
Vue.component('upload', Upload)
Vue.component('file-upload', FileUpload)
Vue.component('cleave', Cleave)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('v-select', vSelect)
Vue.component(quillEditor.name, quillEditor)
Vue.component(FeatherIcon.name, FeatherIcon)
