<template>
  <div>
    <b-container>
      <b-row class="mb-2">
        <b-col
          cols="12"
          class="d-flex justify-content-end"
        >
          <b-button
            variant="danger"
            @click="$router.push({name:'scp.dashboard'})"
          >
            <font-awesome-icon
              :icon="['fas', 'arrow-left']"
            />
          </b-button>
        </b-col>
      </b-row>
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
    </b-container>
  </div>
</template>

<script>
export default {
  name: 'Program',
  computed: {
    ClassroomPrograms() {
      return this.$store.getters['scp/Programs']
    },
    fields() {
      return [
        { key: 'subject_name', label: this.$t('subject_name') },
        { key: 'teacher_name', label: this.$t('teacher_name') },
        { key: 'start_at', label: this.$t('start_at') },
        { key: 'finish_at', label: this.$t('finish_at') },
      ]
    },
    days() {
      return [{ key: 'Monday', value: this.$t('Monday') }, { key: 'Tuesday', value: this.$t('Tuesday') }, { key: 'Wednesday', value: this.$t('Wednesday') }, { key: 'Thursday', value: this.$t('Thursday') }, { key: 'Friday', value: this.$t('Friday') }, { key: 'Saturday', value: this.$t('Saturday') }, { key: 'Sunday', value: this.$t('Sunday') }]
    },
  },
  created() {
    this.$store.dispatch('scp/GetStudentProgram')
  },
}
</script>
