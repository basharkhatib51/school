<template>
  <div>
    <b-row>
      <b-col cols="12">
        <b-card
          v-if="Element"
          :title="$t('Classroom')"
        >
          <b-row class="d-flex justify-content-around">
            <b-col
              cols="12"
              md="3"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'layer-group']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ Element.class_level_name }}
              </h5>
            </b-col>
            <b-col
              cols="12"
              md="3"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'door-closed']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ Element.name }}
              </h5>
            </b-col>
            <b-col
              cols="12"
              md="3"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'users']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ Element.students_count }} {{ $t('Students') }}
              </h5>
            </b-col>
            <b-col
              v-if="Element.subjects_count"
              cols="12"
              md="3"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'book']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ Element.subjects_count }} {{ $t('Subjects') }}
              </h5>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
    <b-tabs>
      <b-tab :title="$t('Students')">
        <b-row>
          <b-col
            cols="12"
            md="8"
          >
            <b-row>
              <b-col cols="12">
                <student-list />
              </b-col>
            </b-row>
          </b-col>
          <b-col
            cols="12"
            md="4"
          >
            <b-card
              bg-variant="light-primary"
              border-variant="primary"
              :title="$t('Edit Classroom')"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="data.name"
                  class="mt-2"
                  :state="errors.name ?false:null"
                  :placeholder="$t('Name')"
                />
                <small
                  v-if="errors.name"
                  class="text-danger"
                >{{ errors.name[0] }}</small>
                <label>{{ $t('Name') }}</label>
              </div>
              <b-button
                variant="success"
                class="w-100"
              >
                {{ $t('Confirm') }}
              </b-button>
            </b-card>
          </b-col>
        </b-row>
      </b-tab>
      <b-tab :title="$t('Subjects')">
        <b-row>
          <b-col
            cols="12"
            md="8"
          >
            <subject-registration-list />
          </b-col>
          <b-col
            cols="12"
            md="4"
          >
            <create-subject-registration />
          </b-col>
        </b-row>

      </b-tab>
      <b-tab :title="$t('Program')">
        <classroom-program />
      </b-tab>
    </b-tabs></div>
</template>

<script>
import StudentList from '@/views/dashboard/generated/classroom/components/student_list.vue'
import SubjectRegistrationList from '@/views/dashboard/generated/classroom/components/subject_registrations_list.vue'
import CreateSubjectRegistration from '@/views/dashboard/generated/classroom/components/create_subject_registration.vue'
import ClassroomProgram from '@/views/dashboard/generated/classroom/components/classroom_program.vue'

export default {
  components: {
    ClassroomProgram, CreateSubjectRegistration, SubjectRegistrationList, StudentList,
  },
  data() {
    return {
      data: {
        name: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    Element() { return this.$store.getters['classroom/GetElement'] },
  },
  created() {
    this.$store.dispatch('teacher/GetTeachers')
    this.getData()
  },
  methods: {
    resetData() {
      this.data = {
        name: '',
      }
      this.errors = []
    },
    setBoolean(val) {
      if (this.data[val] === undefined) { this.data[val] = false }
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    getData() {
      this.$store.dispatch('classroom/GetElement', this.$route.params.classroom).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('classroom/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
