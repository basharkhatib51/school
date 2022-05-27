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
        v-if="studentData.status==='active'"
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to Block this student') }}
      </b-badge>
      <b-badge
        v-if="studentData.status==='blocked' || studentData.status==='blocked' "
        class="mt-1"
        variant="light-success"
      >
        {{ $t('are you sure you want to activate this student') }}
      </b-badge>
      <br>
      <b-badge
        v-if="studentData.status==='blocked'"
        class="mt-2"
        variant="light-danger"
      >
        {{ $t('this student was blocked because') }} {{ studentData.blocked_reason }}
      </b-badge>
      <div v-if="studentData.status==='active'">
        <div class="form-label-group">
          <b-form-input
            v-model="studentData.blocked_reason"
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
    student: {
      default: null,
      type: Number,
    },
  },
  data: () => ({
    errors: [],
    studentData: {},
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
    Student() {
      return this.$store.getters['student/GetStudent']
    },
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('student/GetStudent', this.student).then(() => {
          this.studentData = this.Student
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
      this.studentData = {}
    },
    ChangeStatus() {
      if (this.studentData.status === 'active') {
        this.studentData.status = 'blocked'
      } else if (this.studentData.status === 'deactivated' || this.studentData.status === 'blocked') {
        this.studentData.status = 'active'
      }
      this.$store.dispatch('student/ChangeStatus', this.studentData).then(() => {
        this.close()
      })
    },
  },
}
</script>
