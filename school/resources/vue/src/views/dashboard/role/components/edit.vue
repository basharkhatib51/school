<template>
  <div>
    <b-modal
      ref="my-modal"
      v-model="isActive"
      :title="$t('Edit Role')"
      hide-footer
      no-close-on-backdrop
      @close="close"
      @hide="close"
    >
      <b-row>
        <b-col
          cols="12"
          class="mt-2"
        >
          <div class="form-label-group">
            <b-form-input
              id="floating-label1"
              v-model="roleData.name"
              :state="errors.name ? false:null"
              :placeholder="$t('Name')"
            />
            <small
              v-if="errors.name"
              class="text-danger"
            >{{ errors.name[0] }}</small>
            <label>{{ $t('Name') }}</label>
          </div>
        </b-col>
        <b-col
          cols="12"
          class="mt-2 mb-2"
        >
          <label>{{ $t('Permissions') }}</label>
          <v-select
            v-model="roleData.permissions"
            multiple
            :options="Permissions"
            :reduce="Permissions => Permissions.id"
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
          class="d-flex justify-content-end mt-2"
        >
          <b-button
            variant="primary"
            @click="close"
          >
            {{ $t('Cancel') }}
          </b-button>
          <b-button
            variant="success"
            class="ml-1"
            @click="Edit"
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
  name: 'EditRole',
  props: {
    value: {
      default: null,
      type: Boolean,
    },
    role: {
      default: null,
      type: Number,
    },
  },
  data: () => ({
    errors: [],
    roleData: {},
    selectedPermissions: [],
  }),
  computed: {
    Permissions() {
      return this.$store.getters['role/Permissions']
    },
    isActive: {
      get() {
        return this.getData()
      },
      set(val) {
        this.$emit('input', val)
      },
    },
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('role/GetRole', this.role).then(response => {
          this.roleData = response.data.role
          this.$store.dispatch('role/GetPermissions')
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
      this.roleData = {}
    },
    Edit() {
      this.$store.dispatch('role/Update', this.roleData).then(() => {
        this.errors = []
        this.isActive = false
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
