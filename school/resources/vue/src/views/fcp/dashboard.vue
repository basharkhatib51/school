<template>
  <b-container>
    <b-row>
      <b-col
        v-if="LastYears.length>0"
        cols="12"
      >
        <b-tabs>
          <b-tab
            v-for="year in LastYears"
            :key="year.id"
            :title="year.class_level_name"
          >
            <b-row>
              <b-col
                cols="12"
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
                          {{ year.class_level_name }}
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
                          {{ year.classroom_name }}
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
                            {{ $t('fee') }} {{ year.fee }}
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
                            {{ $t('payments') }} {{ year.payments }}
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
                            {{ $t('debt') }} {{ year.debt }}
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
                            v-b-tooltip.hover="{title:year.created_at,variant:'success',placement:'top'}"
                            variant="light-success"
                          >
                            <font-awesome-icon
                              :icon="['fas', 'table']"
                            />
                            {{ year.created_from }}
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
                            v-b-tooltip.hover="{title:year.total_percentage,variant:'success',placement:'top'}"
                            variant="light-success"
                          >
                            <font-awesome-icon
                              :icon="['fas', 'poll']"
                            />
                            {{ year.total_result }}
                          </b-badge>
                        </h5>
                      </b-col>
                    </b-row>
                  </b-col>
                  <b-row class="mb-2 mt-2">
                    <b-col
                      cols="12"
                      md="6"
                    >
                      <b-input-group>
                        <b-form-input
                          id="filter-input"
                          v-model="filter"
                          type="search"
                          :placeholder="$t('Type to Search')"
                        />
                      </b-input-group>
                    </b-col>
                    <b-col
                      cols="12"
                      md="6"
                      class="d-flex justify-content-end mt-2 mt-md-0"
                    >
                      <b-button
                        v-if="filter!=='first'"
                        variant="success"
                        class="mr-1"
                        @click="filter='first'"
                      >
                        {{ $t('First Semester') }}
                      </b-button>
                      <b-button
                        v-if="filter!=='second'"
                        class="mr-1"
                        variant="primary"
                        @click="filter='second'"
                      >
                        {{ $t('Second Semester') }}
                      </b-button>
                      <b-button
                        v-if="filter"
                        variant="danger"
                        @click="filter=''"
                      >
                        {{ $t('both semesters') }}
                      </b-button>
                    </b-col>
                  </b-row>
                  <b-table
                    v-if="year.results.length>0"
                    :fields="fields"
                    :filter="filter"
                    responsive="sm"
                    :items="year.results"
                    class="table-w-max"
                  >
                    <template #cell(semester)="data">
                      {{ $t(data.value) }}
                    </template>
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
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      errors: [],
      filter: null,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'subject_name', label: this.$t('subject_name') },
        { key: 'subject_percentage', label: this.$t('subject_percentage') },
        { key: 'semester', label: this.$t('semester') },
        { key: 'exams', label: this.$t('exams') },
        { key: 'total', label: this.$t('total') },
      ]
    },
    LastYears() {
      return this.$store.getters['scp/LastYears']
    },
    PaymentsDataFields() {
      return [
        'no',
        'value',
        'created_at',
      ]
    },
  },
  created() {
    this.$store.dispatch('scp/GetLastYearsFamily')
  },
  methods: {
  },
}
</script>
