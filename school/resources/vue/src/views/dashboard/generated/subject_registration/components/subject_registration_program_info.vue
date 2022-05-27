<template>
  <div>
    <b-card :title="$t('Program')">
      <b-table
        v-if="Programs.length>0"
        :fields="fields"
        responsive="sm"
        :items="Programs"
        :filter="filter"
        :per-page="perPage"
        :current-page="currentPage"
        class="table-w-max"
      >
        <template #cell(no)="data">
          <b-badge variant="light-primary">
            {{ data.item.no }}
          </b-badge>
        </template>
        <template #cell(day)="data">
          {{ $t(data.item.day) }}
        </template>
        <template #cell(start_at)="data">
          <b-badge variant="light-success">
            {{ data.item.start_at }}
          </b-badge>
        </template>
        <template #cell(finish_at)="data">
          <b-badge variant="light-danger">
            {{ data.item.finish_at }}
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
      <b-row>
        <b-col
          cols="12"
          class="d-flex justify-content-end mt-2"
        >
          <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            align="center"
            size="sm"
            class="my-0"
          />
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>

export default {
  name: 'SubjectRegistrationProgramInfo',
  data() {
    return {
      filter: null,
      perPage: 5,
      currentPage: 1,
    }
  },
  computed: {
    Programs() { return this.$store.getters['subjectRegistration/GetElement'].subject_registrations.programs },
    fields() {
      return [
        { key: 'no', label: this.$t('no') },
        { key: 'day', label: this.$t('day') },
        { key: 'start_at', label: this.$t('start_at') },
        { key: 'finish_at', label: this.$t('finish_at') },
      ]
    },
    totalRows() {
      return this.Programs.length
    },
  },
}
</script>

<style>

</style>
