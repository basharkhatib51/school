<template>
  <b-row>

    <b-col
      v-if="Student.current_student_registration"
      cols="12"
      lg="8"
    >
      <b-card
        :title="$t('Student Registration')"
      >
        <b-col cols="12">
          <b-row class="d-flex justify-content-around">
            <b-col
              class="text-center"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'layer-group']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ Student.current_student_registration.class_level_name }}
              </h5>
            </b-col>
            <b-col
              class="text-center"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'door-closed']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ Student.current_student_registration.classroom_name }}
              </h5>
            </b-col>
            <b-col
              class="text-center"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'calendar-day']"
                size="2x"
              />
              <h5 class="mt-1">
                <b-badge
                  v-b-tooltip.hover="{title:Student.current_student_registration.created_at,variant:'success',placement:'top'}"
                  variant="light-success"
                >
                  <font-awesome-icon
                    :icon="['fas', 'table']"
                  />
                  {{ Student.current_student_registration.created_from }}
                </b-badge>
              </h5>
            </b-col>
            <b-col
              class="text-center"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'poll']"
                size="2x"
              />
              <h5 class="mt-1">
                <b-badge
                  v-b-tooltip.hover="{title:Student.current_student_registration.total_percentage,variant:'success',placement:'top'}"
                  variant="light-success"
                >
                  <font-awesome-icon
                    :icon="['fas', 'poll']"
                  />
                  {{ Student.current_student_registration.total_result }}
                </b-badge>
              </h5>
            </b-col>
          </b-row>
        </b-col>
        <b-table
          v-if="Student.current_student_registration.results.length>0"
          :fields="fields"
          responsive="sm"
          :items="Student.current_student_registration.results"
          class="table-w-max"
        >
          <template #cell(exams)="data">
            <b-badge
              v-for="exam in data.item.exams"
              :key="exam.exam_name"
              pill
              variant="light-primary"
            >
              {{ exam.exam_name }} {{ exam.result }}/({{ exam.exam_percentage }}%)
            </b-badge>
          </template>
          <template #cell(total)="data">
            <b-badge
              pill
              variant="light-success"
            >
              {{ data.item.total }}/ {{ data.item.subject_percentage }}
            </b-badge>
          </template>
        </b-table>
      </b-card>
      <b-card
        :title="$t('Student Registration Payments')"
      >
        <b-col cols="12">
          <b-row class="d-flex justify-content-around">

            <b-col
              class="text-center"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'file-invoice-dollar']"
                size="2x"
              />
              <h5 class="mt-1">
                <b-badge variant="light-warning">
                  {{ $t('fee') }} {{ Student.current_student_registration.fee }}
                </b-badge>
              </h5>
            </b-col>
            <b-col
              class="text-center"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'money-check-alt']"
                size="2x"
              />
              <h5 class="mt-1">
                <b-badge variant="light-success">
                  {{ $t('payments') }} {{ Student.current_student_registration.payments }}
                </b-badge>
              </h5>
            </b-col>
            <b-col
              class="text-center"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'credit-card']"
                size="2x"
              />
              <h5 class="mt-1">
                <b-badge variant="light-danger">
                  {{ $t('debt') }} {{ Student.current_student_registration.debt }}
                </b-badge>
              </h5>
            </b-col>
          </b-row>
        </b-col>
        <div
          v-if="Student"
        >
          <div
            v-if="Student.current_student_registration"
          >
            <b-table
              v-if="Student.current_student_registration.payments_data.length>0"
              :fields="PaymentsDataFields"
              responsive="sm"
              :items="Student.current_student_registration.payments_data"
              class="table-w-max"
            >
              <template #cell(no)="data">
                <b-badge
                  pill
                  variant="light-primary"
                >
                  {{ data.item.no }}
                </b-badge>
              </template>
              <template #cell(value)="data">
                <b-badge
                  pill
                  variant="light-success"
                >
                  {{ data.item.value }}
                </b-badge>
              </template>
              <template
                #cell(created_at)="data"
              >
                <div>
                  <b-badge
                    v-b-tooltip.hover="{title:data.item.created_at,variant:'success',placement:'top'}"
                    variant="light-success"
                  >
                    <font-awesome-icon
                      :icon="['fas', 'table']"
                    />
                    {{ data.item.created_from }}
                  </b-badge>
                  <b-badge
                    v-b-tooltip.hover="{ title:data.item.created_at,variant:'warning',placement:'top'}"
                    variant="light-warning"
                    class="ml-1"
                  >
                    <font-awesome-icon
                      :icon="['fas', 'calendar-week']"
                    />
                    {{ data.item.updated_from }}
                  </b-badge>
                </div>
              </template>
            </b-table>
          </div>
        </div>
      </b-card>
    </b-col>
    <b-col v-else>
      <b-card :title="$t('No Student Registration yet')">
        <b-alert
          variant="danger"
          show
        >
          <div class="alert-body text-center">
            <span>
              {{ $t('this student not registered yet') }}
            </span>
          </div>
        </b-alert>
      </b-card>
    </b-col>
    <b-col
      cols="12"
      lg="4"
    >
      <b-card
        :title="$t('Register Student')"
      >
        <b-row>
          <b-col
            cols="12"
          >
            <div class="form-label-group">
              <label>{{ $t('please select class level') }}...</label>
              <v-select
                v-model="student_registration.class_level"
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
            v-if="student_registration.class_level"
            cols="12"
          >
            <div class="form-label-group">
              <label>{{ $t('please select classroom') }}...</label>
              <v-select
                v-model="student_registration.classroom"
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
            v-if="student_registration.classroom"
            cols="12"
          >
            <b-button
              variant="gradient-success"
              class="w-100"
              @click="RegisterStudent"
            >
              {{ $t('Register Student') }}
            </b-button>
          </b-col>
        </b-row>
      </b-card>

      <b-card
        v-if="Student.current_student_registration"
        :title="$t('New Payment')"
      >
        <b-row>
          <b-col
            cols="12"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="payment.value"
                class="mt-2"
                :placeholder="$t('Payment Value')"
                :state="errors.value ?false:null"
                type="number"
              />
              <small
                v-if="errors.value"
                class="text-danger"
              >{{ errors.value[0] }}</small>
              <label>{{ $t('Payment Value') }}</label>
            </div>
          </b-col>
          <b-col
            v-if="payment.value"
            cols="12"
          >
            <b-button
              variant="gradient-success"
              class="w-100"
              @click="AddPayment"
            >
              {{ $t('Add Payment') }}
            </b-button>
          </b-col>
        </b-row>
      </b-card>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: 'StudentRegistration',
  data() {
    return {
      student_registration: {

      },
      payment: {},
      errors: [],
    }
  },
  computed: {
    fields() {
      return [
        { key: 'subject_name', label: this.$t('subject_name') },
        { key: 'subject_percentage', label: this.$t('subject_percentage') },
        { key: 'exams', label: this.$t('exams') },
        { key: 'total', label: this.$t('total') },
      ]
    },
    ClassLevels() {
      return this.$store.getters['classLevel/GetElements']
    },
    Classrooms() {
      return this.$store.getters['classroom/GetElements']
    },
    Student() {
      return this.$store.getters['student/GetStudent']
    },

    PaymentsDataFields() {
      return [
        { key: 'no', label: this.$t('no') },
        { key: 'value', label: this.$t('value') },
        { key: 'created_at', label: this.$t('created_at') },
      ]
    },
  },
  watch: {
    'student_registration.class_level': function watch($new) {
      if ($new === null) {
        this.student_registration.classroom = null
      } else {
        this.$store.dispatch('classroom/GetElementsFilter', this.student_registration)
      }
    },
  },
  methods: {
    RegisterStudent() {
      this.student_registration.student = this.$route.params.student
      this.$store.dispatch('studentRegistration/Create', this.student_registration).then(() => {
        this.student_registration = {}
        this.$store.dispatch('student/GetStudent', this.$route.params.student)
      })
    },
    AddPayment() {
      this.payment.student_id = this.$route.params.student
      this.$store.dispatch('payment/Create', this.payment).then(() => {
        this.payment.value = ''
        this.$store.dispatch('student/GetStudent', this.$route.params.student)
      })
    },
  },
}
</script>

<style scoped>

</style>
