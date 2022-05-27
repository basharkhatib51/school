<template>
  <div>
    <b-modal
      v-model="deleteExam"
      :title="$t('Delete Exam')"
      hide-footer
    >
      <b-row>
        <b-col cols="12">
          {{ $t('are you sure you want to delete this exam') }}
          <br>
          <br>
          {{ $t('NOTE') }}:
          <b-badge variant="light-danger">
            {{ $t('All STUDENTS MARKS WILL BE DELETED') }}
          </b-badge>
        </b-col>
        <b-col
          cols="12"
          class="d-flex justify-content-end mt-2"
        >
          <b-button
            variant="success"
            @click="ConfirmDelete"
          >
            {{ $t('Confirm') }}
          </b-button>
          <b-button
            class="ml-1"
            variant="danger"
            @click="deleteExam = false"
          >
            {{ $t('Cancel') }}
          </b-button>
        </b-col>
      </b-row>
    </b-modal>
    <b-card :title="$t('New Exam')">
      <b-row>
        <b-col
          md="6"
          cols="12"
        >
          <div class="form-label-group">
            <b-form-input
              v-model="ExamData.percentage"
              class="mt-2"
              type="number"
              :state="errors.percentage ?false:null"
              :placeholder="$t('Percentage')"
            />
            <small
              v-if="errors.percentage"
              class="text-danger"
            >{{ errors.percentage[0] }}</small>
            <label>{{ $t('Percentage') }}</label>
          </div>
        </b-col>
        <b-col
          md="6"
          cols="12"
        >
          <div class="form-label-group">
            <b-form-input
              v-model="ExamData.type"
              class="mt-2"
              :state="errors.type ?false:null"
              :placeholder="$t('Type')"
            />
            <small
              v-if="errors.type"
              class="text-danger"
            >{{ errors.type[0] }}</small>
            <label>{{ $t('Type') }}</label>
          </div>
        </b-col>
        <b-col
          md="6"
          cols="12"
        >
          <label>{{ $t('Date') }}</label>
          <div class="form-label-group time-input">
            <b-form-datepicker
              v-model="ExamData.date"
              :state="errors.date ?false:null"
            />
            <small
              v-if="errors.date"
              class="text-danger"
            >{{ errors.date[0] }}</small>
          </div>
        </b-col>
        <b-col
          cols="12"
          class="d-flex justify-content-end"
        >
          <b-button
            variant="success"
            @click="CreateExam()"
          >
            {{ $t('Create') }}
          </b-button>
        </b-col>
      </b-row>
    </b-card>
    <b-row>
      <b-col
        v-for="(val,index) in ExamTypes"
        :key="index"
        cols="12"
        lg="4"
      >
        <b-card class="text-center">
          <b-card-title>
            <b-row>
              <b-col
                cols="6"
                class="text-primary d-flex justify-content-start"
              >
                {{ val.exam_name }}
              </b-col>
              <b-col
                cols="6"
                class="d-flex justify-content-end"
              >
                <a
                  class="text-danger"
                  @click="DeleteExam(val.id)"
                >
                  <font-awesome-icon
                    :icon="['fas', 'trash']"
                  />
                </a>
                <router-link
                  class="ml-1 text-success"
                  :to="{name:'tcp.exam_results',params: { exam: val.id }}"
                >
                  <font-awesome-icon
                    :icon="['fas', 'eye']"
                  />
                </router-link>
              </b-col>
            </b-row>
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
                <b-badge
                  v-if="(val.total_results===0 && val.students_taken_Exam===0)"
                  variant="light-danger"
                >
                  No results yet
                </b-badge>

                <b-badge
                  v-else
                  variant="light-info"
                >
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
    </b-row>
  </div>
</template>

<script>

export default {
  name: 'SubjectCreateExam',
  data() {
    return {
      ExamData: {
        date: null,
        percentage: null,
        type: null,
      },
      errors: [],
      deleteExam: false,
      exam: null,
    }
  },
  computed: {
    ExamTypes() {
      return this.$store.getters['tcp/SubjectRegistration'].exam_data
    },
  },
  created() {
  },
  methods: {
    ConfirmDelete() {
      this.$store.dispatch('tcp/DeleteExam', { exam_id: this.exam, subject_registration_id: this.$route.params.subject_registration }).then(() => {
        this.deleteExam = false
      })
    },
    DeleteExam(val) {
      this.deleteExam = true
      this.exam = val
    },
    CreateExam() {
      this.ExamData.subject_registration = this.$route.params.subject_registration
      this.$store.dispatch('tcp/CreateExam', this.ExamData).then(() => {
        this.ExamData = {
          date: null,
          percentage: null,
          type: null,
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>

<style>

</style>
