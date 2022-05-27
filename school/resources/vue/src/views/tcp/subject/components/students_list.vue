<template>
  <div>
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
  </div>
</template>

<script>

export default {
  name: 'SubjectStudentList',
  data() {
    return {
      filter: null,
      perPage: 5,
      currentPage: 1,
    }
  },
  computed: {
    totalRows() {
      return this.Students.length
    },
    ExamTypes() {
      return this.$store.getters['tcp/SubjectRegistration'].exam_data
    },
    Students() {
      return this.$store.getters['tcp/SubjectRegistration'].students
    },
    fields() {
      return [
        { key: 'student_id', label: this.$t('ids') },
        { key: 'student_name', label: this.$t('student_name') },
        ...(this.ExamTypes),
        { key: 'total', label: this.$t('total') },
      ]
    },
  },
  created() {
  },
  methods: {
  },
}
</script>

<style>

</style>
