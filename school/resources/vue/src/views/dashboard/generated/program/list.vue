<template>
  <div>
    <b-card
      class="mt-5"
    >
      <b-card-title>
        <b-row>
          <b-col cols="8">
            <h3>
              {{ $t('Programs') }}
            </h3>
          </b-col>
        </b-row>

        <v-select
          v-model="class_level"
          :options="class_levels"
          :reduce="class_levels => class_levels.id"
          label="name"
          class="my-1"
        />
        <v-select
          v-if="class_level"
          v-model="classroom"
          :options="classrooms"
          :reduce="classrooms => classrooms.id"
          label="name"
        />
      </b-card-title></b-card>
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
            v-if="programs[day.key]"
            :fields="fields"
            responsive="sm"
            :items="programs[day.key]"
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
  data() {
    return {
      class_level: null,
      classroom: null,
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
    class_levels() {
      return this.$store.getters['classLevel/GetElements']
    },
    classrooms() {
      return this.$store.getters['classroom/GetElements']
    },
    programs() {
      return this.$store.getters['classroom/GetElement'].classroom_programs
    },
  },
  watch: {
    class_level: function watch($new) {
      if ($new) {
        this.$store.dispatch('classroom/GetElementsFilter', { class_level: $new })
      }
    },
    classroom: function watch($new) {
      if ($new) {
        this.$store.dispatch('classroom/GetElement', $new)
      }
    },
  },
  created() {
    this.$store.dispatch('classLevel/GetElements')
  },
  methods: {

  },
}
</script>
