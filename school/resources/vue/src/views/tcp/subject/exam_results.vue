<template>
  <div>
    <b-card>
      <b-row>
        <b-col
          cols="12"
          md="2"
          class="text-center mt-1"
        >
          <font-awesome-icon
            class="text-primary"
            :icon="['fas', 'question']"
            size="2x"
          />
          <h5 class="mt-1">
            {{ Exam.exam_name }}
          </h5>
        </b-col>
        <b-col
          cols="12"
          md="2"
          class="text-center mt-1"
        >
          <font-awesome-icon
            class="text-primary"
            :icon="['fas', 'percentage']"
            size="2x"
          />
          <h5 class="mt-1">
            {{ Exam.percentage }}
          </h5>
        </b-col>
        <b-col
          cols="12"
          md="2"
          class="text-center mt-1"
        >
          <font-awesome-icon
            class="text-primary"
            :icon="['fas', 'chart-line']"
            size="2x"
          />
          <h5 class="mt-1">
            {{ Exam.total_results / Exam.attended_students }}
          </h5>
        </b-col>
        <b-col
          cols="12"
          md="2"
          class="text-center mt-1"
        >
          <font-awesome-icon
            class="text-primary"
            :icon="['fas', 'user-graduate']"
            size="2x"
          />
          <h5 class="mt-1">
            {{ Exam.attended_students }}
          </h5>
        </b-col>
        <b-col
          cols="12"
          md="2"
          class="text-center mt-1"
        >
          <font-awesome-icon
            class="text-primary"
            :icon="['fas', 'font']"
            size="2x"
          />
          <h5 class="mt-1">
            {{ Exam.max_grade }}
          </h5>
        </b-col>
        <b-col
          cols="12"
          md="2"
          class="text-center mt-1"
        >
          <font-awesome-icon
            class="text-primary"
            :icon="['fas', 'calendar-week']"
            size="2x"
          />
          <h5 class="mt-1">
            {{ Exam.date }}
          </h5>
        </b-col>
      </b-row>
    </b-card>
    <b-card :title="$t('Students Results')">
      <b-row>
        <b-col cols="12">
          <b-button
            class="w-100 mb-2"
            variant="outline-success"
            @click="UpdateAllResults"
          >
            {{ $t('Update All') }}
          </b-button>
        </b-col>
      </b-row>
      <b-table
        v-if="items.length>0"
        :fields="fields"
        responsive="sm"
        :items="items"
        :filter="filter"
        :per-page="perPage"
        :current-page="currentPage"
        class="table-w-max"
      >
        <template #cell(student_id)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(student_name)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(result_value)="data">
          <b-badge
            pill
            variant="light-success"
          >
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(new_grade)="data">
          <b-form-input
            v-model="grades[data.item.student_id]"
            type="number"
            :state="errors.name ?false:null"
            :placeholder="$t('New Grade')"
          />
          <small
            v-if="errors.name"
            class="text-danger"
          >{{ errors.name[0] }}</small>
        </template>
        <template #cell(update_result)="data">
          <b-button
            v-if="grades[data.item.student_id]"
            variant="outline-success"
            @click="UpdateStudentGrade(data.item.student_id)"
          >
            Update
          </b-button>
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
          class="d-flex justify-content-end mt-1"
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
  data() {
    return {
      grades: {},
      student_grades: [],
      perPage: 5,
      currentPage: 1,
      filter: null,
      errors: [],
    }
  },
  computed: {
    fields() {
      return [
        { key: 'student_id', label: this.$t('student_id') },
        { key: 'student_name', label: this.$t('student_name') },
        { key: 'result_value', label: this.$t('result_value') },
        { key: 'new_grade', label: this.$t('new_grade') },
        { key: 'update_result', label: this.$t('update_result') },
      ]
    },
    totalRows() {
      return this.Exam.length
    },
    Exam() {
      return this.$store.getters['tcp/Exam']
    },
    items() {
      return this.Exam.results
    },
  },
  created() {
    this.$store.dispatch('tcp/GetExam', this.$route.params.exam)
  },
  methods: {
    UpdateAllResults() {
      this.student_grades = []
      Object.entries(this.grades).forEach(([key, val]) => {
        this.student_grades.push({
          student_id: key,
          value: parseInt(val, 10),
        })
      })
      this.$store.dispatch('tcp/updateResults', { results: this.student_grades, exam_id: this.$route.params.exam }).then(() => {
        this.grades = {}
      }).catch(() => {
      })
    },
    UpdateStudentGrade(val) {
      this.$store.dispatch('tcp/updateResult', { student_id: val, value: this.grades[val], exam_id: this.$route.params.exam }).then(() => {
        this.grades = {}
      }).catch(() => {
      })
    },
  },
}
</script>

<style>

</style>
