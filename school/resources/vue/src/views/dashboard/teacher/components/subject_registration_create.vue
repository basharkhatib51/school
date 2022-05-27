<template>
  <b-card
    :title="$t('New Subject')"
  >
    <b-row>

      <b-col
        cols="12"
      >
        <div class="form-label-group">
          <label>{{ $t('please select class level') }}...</label>
          <v-select
            v-model="SubjectRegistrationData.class_level"
            :placeholder="$t('please select class_level')"
            :options="ClassLevels"
            :reduce="ClassLevels => ClassLevels.id"
            label="name"
          />
          <small
            v-if="errors.class_level"
            class="text-danger"
          >{{ errors.class_level[0] }}</small>
        </div>
      </b-col>
      <b-col
        v-if="SubjectRegistrationData.class_level"
        cols="12"
      >
        <div class="form-label-group">
          <label>{{ $t('please select classroom') }}...</label>
          <v-select
            v-model="SubjectRegistrationData.classroom"
            :placeholder="$t('please select classroom')"
            :options="Classrooms"
            :reduce="Classrooms => Classrooms.id"
            label="name"
          />
          <small
            v-if="errors.classroom"
            class="text-danger"
          >{{ errors.classroom[0] }}</small>
        </div>
      </b-col>
      <b-col
        v-if="SubjectRegistrationData.classroom"
        cols="12"
      >
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
      <b-col
        v-if="SubjectRegistrationData.semester"
        cols="12"
      >
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
      <b-col
        v-if="SubjectRegistrationData.subject"
        cols="12"
      >
        <b-button
          variant="gradient-success"
          class="w-100"
          @click="AddSubjectRegistration"
        >
          {{ $t('Add New Subject') }}
        </b-button>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
export default {
  name: 'SubjectRegistrationCreate',
  data() {
    return {
      SubjectRegistrationData: {},
      errors: [],
    }
  },
  computed: {
    ClassLevels() {
      return this.$store.getters['classLevel/GetElements']
    },
    Classrooms() {
      return this.$store.getters['classroom/GetElements']
    },
    Semesters() {
      return [{ id: 'first', name: this.$t('first semester') }, { id: 'second', name: this.$t('second semester') }]
    },
    Subjects() {
      return this.$store.getters['subject/GetElements']
    },
  },
  watch: {
    'SubjectRegistrationData.class_level': function watch($new) {
      if ($new === null) {
        this.SubjectRegistrationData.classroom = null
        this.SubjectRegistrationData.semester = null
        this.SubjectRegistrationData.subject = null
      } else {
        this.$store.dispatch('classroom/GetElementsFilter', this.SubjectRegistrationData)
      }
    },
    'SubjectRegistrationData.classroom': function watch($new) {
      if ($new === null) {
        this.SubjectRegistrationData.semester = null
        this.SubjectRegistrationData.subject = null
      }
    },
    'SubjectRegistrationData.semester': function watch($new) {
      if ($new === null) {
        this.SubjectRegistrationData.subject = null
      } else {
        this.$store.dispatch('subject/GetElementsFilter', this.SubjectRegistrationData)
      }
    },
  },
  created() {
    this.getData()
  },
  methods: {
    getData() {
      this.$store.dispatch('classLevel/GetElements')
    },
    AddSubjectRegistration() {
      this.SubjectRegistrationData.teacher = this.$route.params.teacher
      this.$store.dispatch('subjectRegistration/Create', this.SubjectRegistrationData).then(() => {
        this.SubjectRegistrationData.class_level = null
        this.$store.dispatch('teacher/GetTeacher', this.$route.params.teacher)
      })
    },
  },
}
</script>
