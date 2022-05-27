<template>
  <div>
    <b-card :title="$t('register new subject')">
      <b-row>
        <b-col cols="12">
          <div class="form-label-group">
            <label>{{ $t('please select teacher') }}...</label>
            <v-select
              v-model="SubjectRegistrationData.teacher"
              :placeholder="$t('please select teacher')"
              :options="Teachers"
              :reduce="Teachers => Teachers.id"
              label="name"
            />
            <small
              v-if="errors.teacher"
              class="text-danger"
            >{{ errors.teacher[0] }}</small>
          </div>
        </b-col>
        <b-col cols="12">
          <div class="form-label-group">
            <label>{{ $t('please select semester') }}...</label>
            <v-select
              v-model="SubjectRegistrationData.semester"
              :placeholder="$t('please select semester')"
              :options="Semesters"
              :reduce="Semesters => Semesters.id"
              label="name"
            />
            <small
              v-if="errors.semester"
              class="text-danger"
            >{{ errors.semester[0] }}</small>
          </div>
        </b-col>
        <b-col cols="12">
          <div class="form-label-group">
            <label>{{ $t('please select subject') }}...</label>
            <v-select
              v-model="SubjectRegistrationData.subject"
              :placeholder="$t('please select subject')"
              :options="Subjects"
              :reduce="Subjects => Subjects.id"
              label="name"
            />
            <small
              v-if="errors.subject"
              class="text-danger"
            >{{ errors.subject[0] }}</small>
          </div>
        </b-col>
        <b-col cols="12">
          <b-button
            class="w-100 mt-1"
            variant="success"
            @click="AddSubjectRegistration"
          >
            {{ $t('Create') }}
          </b-button>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>

export default {
  name: 'CreateSubjectRegistration',
  data() {
    return {
      errors: [],
      SubjectRegistrationData: {},
    }
  },
  computed: {
    Semesters() {
      return [{ id: 'first', name: this.$t('first semester') }, { id: 'second', name: this.$t('second semester') }]
    },
    Element() { return this.$store.getters['classroom/GetElement'] },
    Subjects() {
      return this.$store.getters['subject/GetElements']
    },
    Teachers() {
      return this.$store.getters['teacher/GetTeachers']
    },
  },
  watch: {
    'SubjectRegistrationData.semester': function watch($new) {
      if ($new === null) {
        this.SubjectRegistrationData.subject = null
      } else {
        this.SubjectRegistrationData.class_level = this.Element.class_level
        this.SubjectRegistrationData.classroom = this.$route.params.classroom
        this.$store.dispatch('subject/GetElementsFilter', this.SubjectRegistrationData)
      }
    },
  },
  methods: {
    AddSubjectRegistration() {
      this.$store.dispatch('subjectRegistration/Create', this.SubjectRegistrationData).then(() => {
        this.$store.dispatch('classroom/GetElement', this.$route.params.classroom)
        this.errors = []
        this.SubjectRegistrationData.semester = null
        this.SubjectRegistrationData.class_level = null
        this.SubjectRegistrationData.classroom = null
        this.SubjectRegistrationData.teacher = null
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>

<style>

</style>
