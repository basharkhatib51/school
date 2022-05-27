<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Create New Program')"
        >
          <b-row>
            <b-col
              cols="12"
              md="6"
            >
              <div>
                <label>{{ $t('Start_at') }}</label>
                <b-form-timepicker
                  v-model="data.start_at"
                  :placeholder="$t('Start_at')"
                  :state="errors.start_at ?false:null"
                />
                <small
                  v-if="errors.start_at"
                  class="text-danger"
                >{{ errors.start_at[0] }}</small>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div>
                <label>{{ $t('Finish_at') }}</label>
                <b-form-timepicker
                  v-model="data.finish_at"
                  :placeholder="$t('Finish_at')"
                  :state="errors.finish_at ?false:null"
                />
                <small
                  v-if="errors.finish_at"
                  class="text-danger"
                >{{ errors.finish_at[0] }}</small>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div>
                <label>{{ $t('Day') }}</label>
                <v-select
                  v-model="data.day"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="days"
                />
                <small
                  v-if="errors.day"
                  class="text-danger"
                >{{ errors.day[0] }}</small>
              </div>
            </b-col>

          </b-row>
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
            <b-card :title="$t('SubjectRegistrations')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.subject_registration"
                :options="SubjectRegistrationsOptions"
                :reduce="SubjectRegistrations => SubjectRegistrations.id"
                label="name"
              />
              <small
                v-if="errors.subject_registration"
                class="text-danger"
              >{{ errors.subject_registration[0] }}</small>
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
                    @click="create"
                  >
                    {{ $t('Create') }}
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
        start_at: '', finish_at: '', day: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    days() {
      return [this.$t('Monday'), this.$t('Tuesday'), this.$t('Wednesday'), this.$t('Thursday'), this.$t('Friday'), this.$t('Saturday'), this.$t('Sunday')]
    },
    SubjectRegistrations() { return this.$store.getters['subjectRegistration/GetElements'] },
    SubjectRegistrationsOptions() {
      return this.SubjectRegistrations.map(el => ({ id: el.id, name: `${el.class_level_name} ${el.classroom_name} ${el.subject_name} ${el.teacher_data.first_name} ${el.teacher_data.last_name}` }))
    },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.$store.dispatch('subjectRegistration/GetElements')
  },
  methods: {
    resetData() {
      this.data = {
        start_at: '', finish_at: '', day: '',
      }
      this.errors = []
    },
    setBoolean(val) {
      if (this.data[val] === undefined) { this.data[val] = false }
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    create() {
      this.errors = []
      this.$store.dispatch('program/Create', this.data).then(() => {
        this.data = {
          start_at: '', finish_at: '', day: '',
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
