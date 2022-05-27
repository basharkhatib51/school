<template>
  <div>
    <b-container>
      <b-row class="mb-2">
        <b-col
          cols="12"
          class="d-flex justify-content-end"
        >
          <b-button
            variant="danger"
            @click="$router.push({name:'scp.dashboard'})"
          >
            <font-awesome-icon
              :icon="['fas', 'arrow-left']"
            />
          </b-button>
        </b-col>
      </b-row>
      <b-row>
        <b-col
          v-for="(val,index) in Results"
          :key="index"
          cols="12"
          md="6"
        >
          <b-card :title="$t('index')">
            <b-table
              v-if="val"
              :fields="fields"
              responsive="sm"
              :items="val"
              class="table-w-max"
            >
              <template #cell()="data">
                <b-badge
                  pill
                  variant="light-success"
                >
                  {{ data.value }}
                </b-badge>
              </template>
              <template #cell(semester)="data">
                <b-badge
                  pill
                  variant="light-success"
                >
                  {{ $t(data.value) }}
                </b-badge>
              </template>
              <template #cell(result)="data">
                <b-badge
                  pill
                  variant="light-info"
                >
                  {{ data.value }}
                </b-badge>
              </template>
            </b-table>
            <b-row
              v-else
              class="d-flex justify-content-center"
            >
              <b-col
                cols="4"
              >
                <b-alert
                  variant="danger"
                  show
                >
                  <div class="alert-body text-center">
                    <span>{{ $t('No Data Available') }}</span>
                  </div>
                </b-alert>
              </b-col>
            </b-row>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: 'Results',
  computed: {
    fields() {
      return [
        { key: 'exam', label: this.$t('Exam') },
        { key: 'semester', label: this.$t('Semester') },
        { key: 'subject', label: this.$t('Subject') },
        { key: 'from', label: this.$t('From') },
        { key: 'percentage', label: this.$t('Percentage') },
        { key: 'result', label: this.$t('Result') },
      ]
    },
    Results() {
      return this.$store.getters['scp/Results']
    },
  },
  created() {
    this.$store.dispatch('scp/GetStudentResults')
  },
}
</script>
