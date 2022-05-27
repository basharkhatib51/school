<template>
  <div>

    <b-modal
      ref="my-modal"
      v-model="isActive"
      :title="$t('Change Role')"
      no-close-on-backdrop
      hide-footer
      @close="close"
      @hide="close"
    >
      <b-row>
        <b-col
          cols="12"
          class="mt-2 mb-2"
        >
          <label>{{ $t('Roles') }}</label>
          <v-select
            v-model="selectedRole"
            :options="Roles"
            :reduce="Roles => Roles.id"
            label="name"
          />
          <small
            v-if="errors.permissions"
            class="text-danger"
          >{{ errors.permissions[0] }}</small>
        </b-col>
      </b-row>
      <b-row>
        <b-col
          cols="12"
          class="d-flex justify-content-end mt-1"
        >
          <b-button
            class="mx-1"
            variant="primary"
            @click="close"
          >
            {{ $t('Cancel') }}
          </b-button>
          <b-button
            variant="success"
            @click="ChangeRole"
          >
            {{ $t('Confirm') }}
          </b-button>
        </b-col>
      </b-row>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: 'ChangeRole',
  props: {
    value: {
      default: null,
      type: Boolean,
    },
    admin: {
      default: null,
      type: Number,
    },
  },
  data: () => ({
    errors: [],
    selectedRole: null,
    adminData: {},
  }),
  computed: {
    isActive: {
      get() {
        return this.getData()
      },
      set(val) {
        this.$emit('input', val)
      },
    },
    Admin() {
      return this.$store.getters['admin/GetAdmin']
    },
    Roles() {
      return this.$store.getters['role/Roles']
    },
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('admin/GetAdmin', this.admin).then(() => {
          this.adminData = this.Admin
          this.$store.dispatch('role/GetRoles').then(() => {
            this.selectedRole = this.adminData.role.id
          })
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
      this.adminData = {}
      this.selectedRole = null
    },
    ChangeRole() {
      this.$store.dispatch('admin/ChangeRole', { role_id: this.selectedRole, admin: this.adminData.id }).then(() => {
        this.close()
      })
    },
  },
}
</script>

<style lang="scss">
</style>
