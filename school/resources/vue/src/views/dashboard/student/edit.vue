<template>
  <b-tabs

    content-class="mt-3"
  >
    <b-tab
      :title="$t('Student Information')"
      active
    >
      <b-row>
        <b-col
          cols="12"
          md="8"
        >
          <b-card
            :title="$t('Edit Student')"
          >
            <b-row>
              <b-col
                cols="12"
                class="mt-2"
              >
                <span>{{ $t('Student') }}</span>
                <hr>
              </b-col>
              <b-col
                cols="12"
                md="6"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.model_number"
                    class="mt-2"
                    :placeholder="$t('Student Number')"
                    :state="errors.model_number ?false:null"
                  />
                  <small
                    v-if="errors.model_number"
                    class="text-danger"
                  >{{ errors.model_number[0] }}</small>
                  <label>{{ $t('Student Number') }}</label>
                </div>
              </b-col>
              <b-col
                cols="12"
                md="6"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.first_name"
                    class="mt-2"
                    :placeholder="$t('First Name')"
                    :state="errors.first_name ?false:null"
                  />
                  <small
                    v-if="errors.first_name"
                    class="text-danger"
                  >{{ errors.first_name[0] }}</small>
                  <label>{{ $t('First Name') }}</label>
                </div>
              </b-col>
              <b-col
                cols="12"
                md="6"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.last_name"
                    class="mt-2"
                    :placeholder="$t('Last Name')"
                    :state="errors.last_name ?false:null"
                  />
                  <small
                    v-if="errors.last_name"
                    class="text-danger"
                  >
                    {{ errors.last_name[0] }}
                  </small>
                  <label>{{ $t('Last Name') }}</label>
                </div>
              </b-col>
              <b-col
                cols="12"
                md="6"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.phone"
                    class="mt-2"
                    :placeholder="$t('Phone')"
                    :state="errors.phone ?false:null"
                    type="number"
                  />
                  <small
                    v-if="errors.phone"
                    class="text-danger"
                  >
                    {{ errors.phone[0] }}
                  </small>
                  <label>{{ $t('Phone') }}</label>
                </div>
              </b-col>
              <b-col
                v-if="false"
                cols="12"
                md="6"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.email"
                    class="mt-2"
                    :placeholder="$t('Email')"
                    :state="errors.email ?false:null"
                  />
                  <small
                    v-if="errors.email"
                    class="text-danger"
                  >
                    {{ errors.email[0] }}
                  </small>
                  <label>{{ $t('Email') }}</label>
                </div>
              </b-col>
              <b-col
                cols="12"
                class="mt-2"
              >
                <span>{{ $t('Family') }}</span>
                <hr>
              </b-col>
              <b-col
                cols="12"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.family_first_name"
                    class="mt-2"
                    :placeholder="$t('Family First Name')"
                    :state="errors.family_first_name ?false:null"
                  />
                  <small
                    v-if="errors.family_first_name"
                    class="text-danger"
                  >{{ errors.family_first_name[0] }}</small>
                  <label>{{ $t('Family First Name') }}</label>
                </div>
              </b-col>
              <b-col
                v-if="false"
                cols="12"
                md="6"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.family_last_name"
                    class="mt-2"
                    :placeholder="$t('Family Last Name')"
                    :state="errors.family_last_name ?false:null"
                  />
                  <small
                    v-if="errors.family_last_name"
                    class="text-danger"
                  >
                    {{ errors.family_last_name[0] }}
                  </small>
                  <label>{{ $t('Family Last Name') }}</label>
                </div>
              </b-col>
              <b-col
                cols="12"
                md="6"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.family_phone"
                    class="mt-2"
                    :placeholder="$t('Family Phone')"
                    :state="errors.family_phone ?false:null"
                    type="number"
                  />
                  <small
                    v-if="errors.family_phone"
                    class="text-danger"
                  >
                    {{ errors.family_phone[0] }}
                  </small>
                  <label>{{ $t('Family Phone') }}</label>
                </div>
              </b-col>
              <b-col
                cols="12"
                md="6"
              >
                <div class="form-label-group">
                  <b-form-input
                    v-model="studentData.family_email"
                    class="mt-2"
                    :placeholder="$t('Family Email')"
                    :state="errors.family_email ?false:null"
                  />
                  <small
                    v-if="errors.family_email"
                    class="text-danger"
                  >
                    {{ errors.family_email[0] }}
                  </small>
                  <label>{{ $t('Family Email') }}</label>
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
            <b-col cols="12">
              <b-card
                :title="$t('Edit Student')"
              >
                <upload v-model="studentData.avatar_id" />
              </b-card>
            </b-col>
            <b-col cols="12">
              <b-card
                :title="$t('Edit Student')"
                variant="gradient-success"
              >
                <b-button
                  variant="gradient-success"
                  class="w-100"
                  @click="Edit"
                >
                  {{ $t('Confirm') }}
                </b-button>
              </b-card>
            </b-col>
          </b-row>

        </b-col>
      </b-row>
    </b-tab>
    <b-tab
      :title="$t('Current Student Registration')"
    >
      <student-registration />
    </b-tab>
    <b-tab
      :title="$t('Student Registrations')"
    >
      <student-registrations />
    </b-tab>
  </b-tabs>
</template>

<script>
import Upload from '@/layouts/components/Upload.vue'
import StudentRegistration from '@/views/dashboard/student/components/student_registration.vue'
import StudentRegistrations from '@/views/dashboard/student/components/student_registrations.vue'

export default {
  components: {
    Upload,
    StudentRegistration,
    StudentRegistrations,
  },
  data() {
    return {
      student: '',
      studentData: {
        avatar_id: null,
      },
      errors: [],
    }
  },
  computed: {
    Student() {
      return this.$store.getters['student/GetStudent']
    },
  },
  created() {
    this.getData()
  },
  methods: {
    getData() {
      this.$store.dispatch('classLevel/GetElements')
      this.student = this.$route.params.student
      this.$store.dispatch('student/GetStudent', this.student).then(() => {
        this.studentData = this.Student
      })
    },
    Edit() {
      this.$store.dispatch('student/Update', this.studentData).then(() => {
        this.errors = []
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
