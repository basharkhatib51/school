<template>
  <b-row>
    <b-col
      v-if="Student.student_registrations.length>0"
      cols="12"
    >
      <b-tabs>
        <b-tab
          v-for="student_registration in Student.student_registrations"
          :key="student_registration.id"
          :title="student_registration.class_level_name"
        >
          <b-row>
            <b-col
              cols="12"
              lg="8"
            >
              <b-card
                :title="$t('Student Registrations')"
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
                        {{ student_registration.class_level_name }}
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
                        {{ student_registration.classroom_name }}
                      </h5>
                    </b-col>
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
                          {{ $t('fee') }} {{ student_registration.fee }}
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
                          {{ $t('payments') }} {{ student_registration.payments }}
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
                          {{ $t('debt') }} {{ student_registration.debt }}
                        </b-badge>
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
                          v-b-tooltip.hover="{title:student_registration.created_at,variant:'success',placement:'top'}"
                          variant="light-success"
                        >
                          <font-awesome-icon
                            :icon="['fas', 'table']"
                          />
                          {{ student_registration.created_from }}
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
                          v-b-tooltip.hover="{title:student_registration.total_percentage,variant:'success',placement:'top'}"
                          variant="light-success"
                        >
                          <font-awesome-icon
                            :icon="['fas', 'poll']"
                          />
                          {{ student_registration.total_result }}
                        </b-badge>
                      </h5>
                    </b-col>
                  </b-row>
                </b-col>
                <b-table
                  v-if="student_registration.results.length>0"
                  :fields="fields"
                  responsive="sm"
                  :items="student_registration.results"
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
              </b-card></b-col>
            <b-col
              cols="12"
              lg="4"
            >
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
                          {{ $t('fee') }} {{ student_registration.fee }}
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
                          {{ $t('payments') }} {{ student_registration.payments }}
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
                          {{ $t('debt') }} {{ student_registration.debt }}
                        </b-badge>
                      </h5>
                    </b-col>
                  </b-row>
                </b-col>
                <div
                  v-if="Student"
                >
                  <div
                    v-if="student_registration"
                  >
                    <b-table
                      v-if="student_registration.payments_data.length>0"
                      :fields="PaymentsDataFields"
                      responsive="sm"
                      :items="student_registration.payments_data"
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
              </b-card></b-col>
          </b-row>

        </b-tab>
      </b-tabs>
    </b-col>
    <b-col v-else>
      <b-card :title="$t('No Student Registrations')">
        <b-alert
          variant="danger"
          show
        >
          <div class="alert-body text-center">
            <span>
              {{ $t("Student doesn't have any registration before this time") }}
            </span>
          </div>
        </b-alert>
      </b-card>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: 'StudentRegistration',
  data() {
    return {
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
  methods: {
    RegisterStudent() {
      this.student_registration.student = this.$route.params.student
      this.$store.dispatch('studentRegistration/Create', this.student_registration).then(() => {
        this.$store.dispatch('student/GetStudent', this.$route.params.student)
      })
    },
  },
}
</script>

<style scoped>

</style>
