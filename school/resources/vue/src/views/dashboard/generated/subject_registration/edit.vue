<template>
  <div>
    <subject-registration-info />
    <b-tabs>
      <b-tab :title="$t('Grades')">
        <subject-registration-exams-info />
      </b-tab>
      <b-tab :title="$t('Teacher')">
        <b-row>
          <b-col
            cols="12"
            md="8"
          >
            <subject-registration-program-info />
          </b-col>
          <b-col
            cols="12"
            md="4"
          >
            <b-card
              :title="$t('Teacher')"
            >
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="teacherData.teacher"
                :options="Teachers"
                :reduce="Teachers => Teachers.id"
                label="first_name"
              />
              <small
                v-if="errors.teacher"
                class="text-danger"
              >{{ errors.teacher[0] }}</small>
              <b-button
                class="w-100 mt-1"
                variant="gradient-success"
                @click="update"
              >
                {{ $t('Update') }}
              </b-button>
            </b-card>
          </b-col>
        </b-row>
      </b-tab>
      <b-tab :title="$t('New Program')">
        <b-row class="d-flex justify-content-center">
          <b-col
            cols="8"
          >
            <b-card
              :title="$t('Create Program')"
            >
              <b-row>
                <b-col
                  cols="12"
                  md="6"
                >
                  <div class="time-input">
                    <label>{{ $t('Start_at') }}</label>
                    <b-form-timepicker
                      v-model="programData.start_at"
                      :placeholder="$t('Start_at')"
                      :state="programErrors.start_at ?false:null"
                    />
                    <small
                      v-if="programErrors.start_at"
                      class="text-danger"
                    >{{ programErrors.start_at[0] }}</small>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                  md="6"
                >
                  <div class="time-input">
                    <label>{{ $t('Finish_at') }}</label>
                    <b-form-timepicker
                      v-model="programData.finish_at"
                      :placeholder="$t('Finish_at')"
                      :state="programErrors.finish_at ?false:null"
                    />
                    <small
                      v-if="programErrors.finish_at"
                      class="text-danger"
                    >{{ programErrors.finish_at[0] }}</small>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                  md="6"
                >
                  <div>
                    <label>{{ $t('Day') }}</label>
                    <v-select
                      v-model="programData.day"
                      :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                      label="title"
                      :options="['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday',' Sunday']"
                    />
                    <small
                      v-if="programErrors.day"
                      class="text-danger"
                    >{{ programErrors.day[0] }}</small>
                  </div>
                </b-col>
                <b-col cols="12">
                  <b-button
                    class="w-100 mt-2"
                    variant="success"
                    @click="create"
                  >
                    {{ $t('Create') }}
                  </b-button>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
      </b-tab>
    </b-tabs>
  </div>
</template>

<script>
import SubjectRegistrationInfo
  from '@/views/dashboard/generated/subject_registration/components/subject_registration_info.vue'
import SubjectRegistrationExamsInfo
  from '@/views/dashboard/generated/subject_registration/components/subject_registration_exams_info.vue'
import SubjectRegistrationProgramInfo
  from '@/views/dashboard/generated/subject_registration/components/subject_registration_program_info.vue'

export default {
  components: { SubjectRegistrationProgramInfo, SubjectRegistrationExamsInfo, SubjectRegistrationInfo },
  data() {
    return {
      programData: {
        start_at: '', finish_at: '', day: '',
      },
      teacherData: {
        teacher: null,
        subject_registration: null,
      },
      errors: [],
      programErrors: [],
    }
  },
  computed: {
    Teachers() { return this.$store.getters['teacher/GetTeachers'] },
  },
  created() {
    this.$store.dispatch('teacher/GetTeachers')
    this.getData()
  },
  methods: {
    resetData() {
      this.teacherData = {}
      this.errors = []
    },
    create() {
      this.programErrors = []
      this.programData.subject_registration = this.$route.params.subject_registration
      this.$store.dispatch('program/Create', this.programData).then(() => {
        this.getData()
        this.programData = {
          start_at: '', finish_at: '', day: '',
        }
      }).catch(error => {
        this.programErrors = error.response.data.errors
      })
    },
    getData() {
      this.$store.dispatch('subjectRegistration/GetElement', this.$route.params.subject_registration).then(() => {
        this.teacherData.teacher = this.$store.getters['subjectRegistration/GetElement'].subject_registrations.teacher
      })
    },
    update() {
      this.teacherData.subject_registration = this.$route.params.subject_registration
      this.errors = []
      this.$store.dispatch('subjectRegistration/Update', this.teacherData).then(() => {
        this.getData()
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
