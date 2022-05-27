<template>
  <div>
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
            v-if="TeacherPrograms[day.key]"
            :fields="fields"
            responsive="sm"
            :items="TeacherPrograms[day.key]"
            class="table-w-max"
          >
            <template #cell()="data">
              <b-badge variant="light-primary">
                {{ data.value }}
              </b-badge>
            </template>
            <template #cell(subject_name)="data">
              <b-badge variant="light-info">
                {{ data.item.subject_name }}
              </b-badge>
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
  </div>
</template>

<script>

export default {
  data() {
    return {
      program: null,
    }
  },
  computed: {
    TeacherPrograms() {
      return this.$store.getters['tcp/GetPrograms']
    },
    days() {
      return [{ key: 'Monday', value: this.$t('Monday') }, { key: 'Tuesday', value: this.$t('Tuesday') }, { key: 'Wednesday', value: this.$t('Wednesday') }, { key: 'Thursday', value: this.$t('Thursday') }, { key: 'Friday', value: this.$t('Friday') }, { key: 'Saturday', value: this.$t('Saturday') }, { key: 'Sunday', value: this.$t('Sunday') }]
    },
    fields() {
      return [
        { key: 'class_level_name', label: this.$t('class_level_name') },
        { key: 'classroom_name', label: this.$t('classroom_name') },
        { key: 'subject_name', label: this.$t('subject_name') },
        { key: 'start_at', label: this.$t('start_at') },
        { key: 'finish_at', label: this.$t('finish_at') },
      ]
    },
  },
  created() {
    this.$store.dispatch('tcp/GetPrograms')
  },
}
</script>

<style>

</style>
