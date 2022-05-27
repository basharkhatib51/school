<template>
  <div>
    <b-modal
      ref="my-modal"
      v-model="isActive"
      :title="$t('New Role')"
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
              id="role"
              v-model="role.name"
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
            v-model="role.permissions"
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
            @click="create"
          >
            {{ $t('Create') }}
          </b-button>
        </b-col>
      </b-row>
    </b-modal>

  </div>
</template>

<script>
export default {
  name: 'CreateRole',
  props: {
    value: {
      default: null,
      type: Boolean,
    },
  },
  data: () => ({
    errors: [],
    role: {
      permissions: [],
      name: '',
    },
  }),
  computed: {
    Permissions() {
      return this.$store.getters['role/Permissions']
    },
    isActive: {
      get() {
        return this.value
      },
      set(val) {
        this.$emit('input', val)
      },
    },
  },
  watch: {
    value(val) {
      if (val) {
        this.$store.dispatch('role/GetPermissions')
      }
    },
  },
  methods: {
    close() {
      this.isActive = false
      this.role.permissions = []
      this.role.name = ''
      this.errors = []
    },
    create() {
      this.$store.dispatch('role/Create', this.role).then(() => {
        this.role.permissions = []
        this.role.name = ''
        this.errors = []
        this.isActive = false
      }).catch(error => {
        this.errors = error.response.data.errors
        this.role.permissions = []
        this.role.name = ''
      })
    },
  },
}
</script>
