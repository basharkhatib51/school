<template>
  <div>
    <b-modal
      v-model="isActive"
      :title="$t('Change Status')"
      hide-footer
      no-close-on-backdrop
      @close="close"
      @hide="close"
    >
      <b-badge
        v-if="adminData.status==='active'"
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to Block this admin') }}
      </b-badge>
      <b-badge
        v-if="adminData.status==='blocked' || adminData.status==='blocked' "
        class="mt-1"
        variant="light-success"
      >
        {{ $t('are you sure you want to activate this admin') }}
      </b-badge>
      <br>
      <b-badge
        v-if="adminData.status==='blocked'"
        class="mt-2"
        variant="light-danger"
      >
        {{ $t('this admin was blocked because') }} {{ adminData.blocked_reason }}
      </b-badge>
      <div v-if="adminData.status==='active'">
        <div class="form-label-group">
          <b-form-input
            v-model="adminData.blocked_reason"
            class="mt-3"
            :placeholder="$t('Blocked Reason')"
          />
          <label>{{ $t('Blocked Reason') }}</label>
        </div>
      </div>

      <b-row>
        <b-col
          cols="12"
          class="d-flex justify-content-end mt-1"
        >
          <b-button
            variant="primary"
            class="mx-1"
            @click="close"
          >
            {{ $t('Cancel') }}
          </b-button>
          <b-button
            variant="success"
            @click="ChangeStatus"
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
  name: 'ChangeStatus',
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
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('admin/GetAdmin', this.admin).then(() => {
          this.adminData = this.Admin
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
      this.adminData = {}
    },
    ChangeStatus() {
      if (this.adminData.status === 'active') {
        this.adminData.status = 'blocked'
      } else if (this.adminData.status === 'deactivated' || this.adminData.status === 'blocked') {
        this.adminData.status = 'active'
      }
      this.$store.dispatch('admin/ChangeStatus', this.adminData).then(() => {
        this.close()
      })
    },
  },
}
</script>

<style lang="scss">
</style>
