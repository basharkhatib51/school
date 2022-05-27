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
        v-if="teacherData.status==='active'"
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to Block this teacher') }}
      </b-badge>
      <b-badge
        v-if="teacherData.status==='blocked' || teacherData.status==='blocked' "
        class="mt-1"
        variant="light-success"
      >
        {{ $t('are you sure you want to activate this teacher') }}
      </b-badge>
      <br>
      <b-badge
        v-if="teacherData.status==='blocked'"
        class="mt-2"
        variant="light-danger"
      >
        {{ $t('this teacher was blocked because') }} {{ teacherData.blocked_reason }}
      </b-badge>
      <div v-if="teacherData.status==='active'">
        <div class="form-label-group">
          <b-form-input
            v-model="teacherData.blocked_reason"
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
    teacher: {
      default: null,
      type: Number,
    },
  },
  data: () => ({
    errors: [],
    teacherData: {},
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
    Teacher() {
      return this.$store.getters['teacher/GetTeacher']
    },
  },
  methods: {
    getData() {
      if (this.value) {
        this.$store.dispatch('teacher/GetTeacher', this.teacher).then(() => {
          this.teacherData = this.Teacher
        })
      }
      return this.value
    },
    close() {
      this.isActive = false
      this.teacherData = {}
    },
    ChangeStatus() {
      if (this.teacherData.status === 'active') {
        this.teacherData.status = 'blocked'
      } else if (this.teacherData.status === 'deactivated' || this.teacherData.status === 'blocked') {
        this.teacherData.status = 'active'
      }
      this.$store.dispatch('teacher/ChangeStatus', this.teacherData).then(() => {
        this.close()
      })
    },
  },
}
</script>
