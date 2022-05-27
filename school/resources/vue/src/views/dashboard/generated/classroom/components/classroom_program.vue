<template>
  <div>
    <b-modal
      v-model="DeleteProgram"
      :title="$t('Delete Program')"
      :ok-title="$t('Delete')"
      :cancel-title="$t('cancel')"
      ok-variant="danger"
      cancel-variant="primary"
      @close="DeleteProgram=false"
      @cancel="DeleteProgram=false"
      @ok="ConfirmDelete"
    >
      <b-badge
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to delete this Program') }}
      </b-badge>
    </b-modal>
    <b-row>
      <b-col
        v-for="day in days"
        :key="day.key"
        cols="12"
        md="6"
      >
        <b-card
          :title="day.value"
        >
          <b-table
            v-if="ClassroomPrograms[day.key]"
            :fields="fields"
            responsive="sm"
            :items="ClassroomPrograms[day.key]"
            class="table-w-max"
          >
            <template #cell(subject_name)="data">
              <b-badge variant="light-info">
                {{ data.item.subject_name }}
              </b-badge>
            </template>
            <template #cell(teacher_name)="data">
              {{ data.item.teacher_name }}
            </template>
            <template #cell(start_at)="data">
              <b-badge variant="light-success">
                {{ data.item.start_at }}
              </b-badge>
            </template>
            <template #cell(finish_at)="data">
              <b-badge variant="light-danger">
                {{ data.item.finish_at }}
              </b-badge>
            </template>
            <template #cell(options)="data">
              <a @click="Delete(data.item.id)">
                <font-awesome-icon
                  class="text-danger"
                  :icon="['fas', 'trash']"
                />
              </a>
            </template>
          </b-table>
          <b-row
            v-else
            class="d-flex justify-content-center"
          >
            <b-col
              cols="4"
            >
              <b-alert
                variant="danger"
                show
              >
                <div class="alert-body text-center">
                  <span>{{ $t('No Data Available') }}</span>
                </div>
              </b-alert>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>

export default {
  name: 'ClassroomProgram',
  data() {
    return {
      program: null,
      DeleteProgram: false,
    }
  },
  computed: {

    days() {
      return [{ key: 'Monday', value: this.$t('Monday') }, { key: 'Tuesday', value: this.$t('Tuesday') }, { key: 'Wednesday', value: this.$t('Wednesday') }, { key: 'Thursday', value: this.$t('Thursday') }, { key: 'Friday', value: this.$t('Friday') }, { key: 'Saturday', value: this.$t('Saturday') }, { key: 'Sunday', value: this.$t('Sunday') }]
    },
    fields() {
      return [
        { key: 'subject_name', label: this.$t('subject_name') },
        { key: 'teacher_name', label: this.$t('teacher_name') },
        { key: 'start_at', label: this.$t('start_at') },
        { key: 'finish_at', label: this.$t('finish_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    ClassroomPrograms() { return this.$store.getters['classroom/GetElement'].classroom_programs },
  },
  methods: {
    ConfirmDelete() {
      this.$store.dispatch('program/Delete', this.program).then(() => {
        this.$store.dispatch('classroom/GetElement', this.$route.params.classroom)
      })
    },
    Delete(val) {
      this.program = val
      this.DeleteProgram = true
    },
  },
}
</script>

<style>

</style>
