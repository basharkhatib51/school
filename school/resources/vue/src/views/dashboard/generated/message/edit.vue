<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Edit Message')"
        >
          <b-row>
            <b-col
              cols="12"
              md="12"
            >
              <div class="form-label-group">
                <b-form-textarea
                  v-model="data.content"
                  rows="4"
                  class="mt-2"
                  :placeholder="$t('Content')"
                  :state="errors.content ?false:null"
                />
                <small
                  v-if="errors.content"
                  class="text-danger"
                >{{ errors.content[0] }}</small>
                <label>{{ $t('Content') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div>
                <label>{{ $t('Sender_type') }}</label>
                <v-select
                  v-model="data.sender_type"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="['student','teacher']"
                />
                <small
                  v-if="errors.sender_type"
                  class="text-danger"
                >{{ errors.sender_type[0] }}</small>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div>
                <label>{{ $t('Reciver_type') }}</label>
                <v-select
                  v-model="data.reciver_type"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="['subject','student','teacher']"
                />
                <small
                  v-if="errors.reciver_type"
                  class="text-danger"
                >{{ errors.reciver_type[0] }}</small>
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
            <b-card :title="$t('Teachers')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.teacher"
                :options="Teachers"
                :reduce="Teachers => Teachers.id"
                label="name"
              />
              <small
                v-if="errors.teacher"
                class="text-danger"
              >{{ errors.teacher[0] }}</small>
            </b-card>
          </b-col>
          <b-col
            cols="12"
          >
            <b-card :title="$t('SubjectRegistrations')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.subject_registration"
                :options="SubjectRegistrations"
                :reduce="SubjectRegistrations => SubjectRegistrations.id"
                label="name"
              />
              <small
                v-if="errors.subject_registration"
                class="text-danger"
              >{{ errors.subject_registration[0] }}</small>
            </b-card>
          </b-col>

          <b-col
            cols="12"
            class="justify-content-center"
          >
            <b-card :title="$t('Image')">
              <b-row>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center"
                >
                  <upload
                    v-model="data.image"
                    @on-file-error="UpdateFileError"
                  />
                </b-col>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center mt-2"
                >
                  <small
                    v-if="errors.image"
                    class="text-danger"
                  >{{ errors.image[0] }}</small>
                </b-col>
                <b-col cols="12">
                  <b-alert
                    v-if="fileErrors.length>0"
                    variant="danger"
                    show
                  >
                    <h4 class="alert-heading">
                      {{ $t('Upload Image Error') }}
                    </h4>
                    <div class="alert-body">
                      <span>
                        <ul
                          v-for="(val,index) in fileErrors"
                          :key="index"
                        >
                          <li>{{ val }}</li>
                        </ul>
                      </span>
                    </div>
                  </b-alert>
                </b-col>
              </b-row>
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
        content: '', sender_type: '', reciver_type: '', image: null,
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    Students() { return this.$store.getters['student/GetElements'] },

    Teachers() { return this.$store.getters['teacher/GetElements'] },

    SubjectRegistrations() { return this.$store.getters['subjectRegistration/GetElements'] },

    Element() { return this.$store.getters['message/GetElement'] },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.$store.dispatch('student/GetElements')

    this.$store.dispatch('teacher/GetElements')

    this.$store.dispatch('subjectRegistration/GetElements')

    this.getData()
  },
  methods: {
    resetData() {
      this.data = {
        content: '', sender_type: '', reciver_type: '', image: null,
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
      this.$store.dispatch('message/GetElement', this.$route.params.message).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('message/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
