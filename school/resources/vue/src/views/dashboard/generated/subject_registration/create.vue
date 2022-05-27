<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Create New SubjectRegistration')"
        >
          <b-row>
            <b-col
              cols="12"
              md="6"
            >
              <div class="demo-inline-spacing">
                <b-form-checkbox
                  v-model="data.chat_status"
                  :value="true"
                  :state="errors.chat_status ?false:null"
                  :fake="setBoolean('chat_status')"
                >
                  {{ $t('Chat_status') }}
                </b-form-checkbox>
              </div>
              <small
                v-if="errors.chat_status"
                class="text-danger"
              >{{ errors.chat_status[0] }}</small>
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
            <b-card :title="$t('Subjects')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.subject"
                :options="Subjects"
                :reduce="Subjects => Subjects.id"
                label="name"
              />
              <small
                v-if="errors.subject"
                class="text-danger"
              >{{ errors.subject[0] }}</small>
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
        chat_status: false,
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    Subjects() { return this.$store.getters['subject/GetElements'] },

    Classrooms() { return this.$store.getters['classroom/GetElements'] },

    Teachers() { return this.$store.getters['teacher/GetElements'] },

  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.$store.dispatch('subject/GetElements')

    this.$store.dispatch('classroom/GetElements')

    this.$store.dispatch('teacher/GetElements')

    this.$store.dispatch('year/GetElements')
  },
  methods: {
    resetData() {
      this.data = {
        chat_status: false,
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
      this.$store.dispatch('subjectRegistration/Create', this.data).then(() => {
        this.data = {
          chat_status: false,
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
