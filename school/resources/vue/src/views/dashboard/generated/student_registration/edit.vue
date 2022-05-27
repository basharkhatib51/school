<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Edit StudentRegistration')"
        >
          <b-row />
        </b-card>
      </b-col>
      <b-col
        cols="12"
        md="4"
      >
        <b-row>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Students')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.student"
                :options="Students"
                :reduce="Students => Students.id"
                label="name"
              />
              <small
                v-if="errors.student"
                class="text-danger"
              >{{ errors.student[0] }}</small>
            </b-card>
          </b-col>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Classrooms')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.classroom"
                :options="Classrooms"
                :reduce="Classrooms => Classrooms.id"
                label="name"
              />
              <small
                v-if="errors.classroom"
                class="text-danger"
              >{{ errors.classroom[0] }}</small>
            </b-card>
          </b-col>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Years')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.year"
                :options="Years"
                :reduce="Years => Years.id"
                label="name"
              />
              <small
                v-if="errors.year"
                class="text-danger"
              >{{ errors.year[0] }}</small>
            </b-card>
          </b-col>

          <b-col cols="12">
            <b-card>
              <b-row>
                <b-col
                  cols="12"
                >
                  <b-button
                    class="w-100 mb-1"
                    variant="gradient-success"
                    @click="update"
                  >
                    {{ $t('Update') }}
                  </b-button>
                  <b-button
                    class="w-100"
                    variant="gradient-danger"
                    @click="resetData"
                  >
                    {{ $t('Reset Form') }}
                  </b-button>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
      </b-col>

    </b-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {

      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    Students() { return this.$store.getters['student/GetElements'] },

    Classrooms() { return this.$store.getters['classroom/GetElements'] },

    Years() { return this.$store.getters['year/GetElements'] },

    Element() { return this.$store.getters['studentRegistration/GetElement'] },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.$store.dispatch('student/GetElements')

    this.$store.dispatch('classroom/GetElements')

    this.$store.dispatch('year/GetElements')

    this.getData()
  },
  methods: {
    resetData() {
      this.data = {

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
      this.$store.dispatch('studentRegistration/GetElement', this.$route.params.student_registration).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('studentRegistration/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
