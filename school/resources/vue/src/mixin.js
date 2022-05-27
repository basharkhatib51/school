import Vue from 'vue'

const Mixin = {
  methods: {
    haveRouteAccess(required = null, type = 'any') {
      if (Mixin.computed.MixInIsAuth() === false) return false
      if (Mixin.computed.MixInAuth().role.name === 'SuperAdmin') return true
      if (required === null) return true
      let permissions = []
      if (Mixin.computed.MixInAuth().role) {
        if (Mixin.computed.MixInAuth().role.permissions) permissions = Mixin.computed.MixInAuth().role.permissions.map(val => val.name)
        else permissions = []
      }
      if (Array.isArray(required)) {
        if (type === 'any' && required.some(e => permissions.includes(e))) return true
        if (type === 'all' && required.every(e => permissions.includes(e))) return true
      } else return permissions.includes(required)
      return false
    },
    haveAccess(required = null, type = 'any') {
      if (required === null) return true
      if (this.MixInIsAuth === false) return false
      if (this.MixInRole.name === 'SuperAdmin') return true
      let permissions = []
      if (this.MixInRole) {
        if (this.MixInPermissions) permissions = this.MixInPermissions.map(val => val.name)
        else permissions = []
      }
      if (Array.isArray(required)) {
        if (type === 'any' && required.some(e => permissions.includes(e))) return true
        if (type === 'all' && required.every(e => permissions.includes(e))) return true
      } else return permissions.includes(required)
      return false
    },
    haveUserType(required = null) {
      if (required === null) return true
      if (this.MixInIsAuth === false) return false
      return this.MixInUserType === required
    },
    haveRootUserType(required = null) {
      if (required === null) return true
      if (Mixin.computed.MixInIsAuth() === false) return false
      return Mixin.computed.MixInAuth().user_type === required
    },
    haveRole(required = null) {
      if (required === null) return true
      if (this.MixInIsAuth === false) return false
      return (this.MixInRole.name === 'SuperAdmin' || this.MixInRole.name === required)
    },
    haveElementAccess(required = null, createdById = null) {
      if (this.MixInIsAuth === false) return false
      if (this.MixInRole.name === 'SuperAdmin') return true
      return (this.haveAccess(required) && this.MixInAuth.id === createdById)
    },
  },
  computed: {
    MixInIsAuth() {
      return Vue.prototype.$store.getters['auth/isAuth']
    },
    MixInAuth() {
      return Vue.prototype.$store.getters['auth/GetAuth']
    },
    MixInRole() {
      return this.MixInAuth.role
    },
    MixInPermissions() {
      return this.MixInAuth.permissions
    },
    MixInUserType() {
      return this.MixInAuth.user_type
    },
    langEx() {
      if (this.$i18n.locale === 'ar' || this.$i18n.locale === 'tr') return `_${this.$i18n.locale}`
      return ''
    },
  },
}
export default Mixin
