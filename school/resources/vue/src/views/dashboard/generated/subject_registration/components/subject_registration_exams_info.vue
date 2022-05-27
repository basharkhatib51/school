<template>
  <div>
    <b-row>
      <b-col
        v-for="(val,index) in ExamTypes"
        :key="index"
        cols="12"
        lg="4"
      >
        <b-card class="text-center">
          <b-card-title class="text-primary">
            {{ val.exam_name }}
          </b-card-title>
          <b-card-body>
            <b-row>
              <b-col cols="6">
                <h6>
                  {{ $t('number of students') }}
                </h6>
              </b-col>
              <b-col
                cols="6"
              >
                <b-badge variant="light-info">
                  {{ val.student_count }}
                </b-badge>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <h6>
                  {{ $t('attended students') }}
                </h6>
              </b-col>
              <b-col
                cols="6"
                class="mt-1"
              >
                <b-badge variant="light-info">
                  {{ val.attended_students }}
                </b-badge>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <h6>
                  {{ $t('Percentage') }}
                </h6>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <b-badge variant="light-info">
                  {{ val.percentage }}
                </b-badge>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <h6>
                  {{ $t('Average') }}
                </h6>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <b-badge variant="light-info">
                  {{ val.total_results / val.students_taken_Exam }}
                </b-badge>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <h6>
                  {{ $t('total results') }}
                </h6>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <b-badge variant="light-info">
                  {{ val.total_results }}
                </b-badge>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <h6>
                  {{ $t('Date') }}
                </h6>
              </b-col>
              <b-col
                class="mt-1"
                cols="6"
              >
                <b-badge variant="light-info">
                  {{ val.date }}
                </b-badge>
              </b-col>
            </b-row>
          </b-card-body>
        </b-card>
      </b-col>
      <b-col cols="12">
        <b-card :title="$t('Students Results')">
          <b-table
            v-if="Students.length>0"
            :fields="fields"
            responsive="sm"
            :items="Students"
            :filter="filter"
            :per-page="perPage"
            :current-page="currentPage"
            class="table-w-max"
          >
            <template #cell(student_id)="data">
              <b-badge variant="light-primary">
                {{ data.item.student_id }}
              </b-badge>
            </template>
            <template #cell(student_name)="data">
              {{ data.item.student_name }}
            </template>
            <template #cell(total)="data">
              <b-badge variant="light-warning">
                {{ data.item.total }}
              </b-badge>
            </template>
            <template
              #cell()="data"
            >
              <b-badge :variant="data.item.exams[data.field.key]!==undefined?'light-info':'light-danger'">
                {{ data.item.exams[data.field.key]!==undefined?data.item.exams[data.field.key]:'did not attend' }}
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
          <b-row>
            <b-col
              cols="12"
              class="d-flex justify-content-end mt-2"
            >
              <b-pagination
                v-model="currentPage"
                :total-rows="totalRows"
                :per-page="perPage"
                align="center"
                size="sm"
                class="my-0"
              />
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>

export default {
  name: 'SubjectRegistrationExamsInfo',
  data() {
    return {
      filter: null,
      perPage: 5,
      currentPage: 1,
    }
  },
  computed: {
    ExamTypes() { return this.$store.getters['subjectRegistration/GetElement'].exams_types },
    Students() { return this.$store.getters['subjectRegistration/GetElement'].students },
    fields() {
      return [
        { key: 'student_id', label: this.$t('ids') },
        { key: 'student_name', label: this.$t('student_name') },
        ...(this.ExamTypes),
        { key: 'total', label: this.$t('total') },
      ]
    },
    totalRows() {
      return this.Students.length
    },
  },
}
</script>

<style>

</style>
