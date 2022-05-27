<template>
  <div>
    <b-modal
      ref="my-modal"
      v-model="isActive"
      :title="$t('Permissions')"
      :ok-title="$t('Ok')"
      ok-only
      ok-variant="primary"
      no-close-on-backdrop
      @ok="close"
      @close="close"
      @hide="close"
    >
      <b-row>
        <b-col
          cols="12"
          class="mt-1"
        >
          <b-badge
            v-for="(tr, indextr) in roleData.permissions"
            :key="indextr"
            variant="primary"
            class="mr-1 mb-1"
          >
            {{ tr.name }}
          </b-badge>
        </b-col>
      </b-row>
    </b-modal>

  </div>
</template>

<script>
export default {
  name: 'Permissions',
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
    roleData: {},
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
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('role/GetRole', this.role).then(response => {
          this.roleData = response.data.role
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
    },
  },
}
</script>
