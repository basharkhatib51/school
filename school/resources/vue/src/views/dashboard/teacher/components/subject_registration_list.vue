<template>
  <div>
    <b-modal
      v-model="deleteElement"
      :title="$t('Delete Classroom')"
      :ok-title="$t('Delete')"
      :cancel-title="$t('cancel')"
      ok-variant="danger"
      cancel-variant="primary"
      @close="deleteElement=false"
      @cancel="deleteElement=false"
      @ok="ConfirmDelete"
    >
      <h5>
        {{ $t('are you sure you want to delete this Subject Relation') }}
      </h5>
      <b-badge
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('you will lose related (marks and massage and weekly program) on accept') }}
      </b-badge>
    </b-modal>
    <b-card
      v-if="Teacher"
      :title="$t('Subject')"
    >
      <b-row class="mb-3">
        <b-col cols="6">
          <v-select
            v-model="selected_year"
            :reduce="years => years.name"
            label="name"
            :options="years"
          />
        </b-col>
        <b-col
          cols="6"
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
      </b-row>
      <b-table
        v-if="yearly_items.length>0"
        :fields="fields"
        responsive="sm"
        :items="yearly_items"
        :filter="filter"
        :per-page="perPage"
        :current-page="currentPage"
        class="table-w-max"
      >
        <template #cell(id)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item.no }}
          </b-badge>
        </template>
        <template #cell(year)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item.year }}
          </b-badge>
        </template>
        <template #cell(percentage)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item.percentage }}
          </b-badge>
        </template>
        <template
          #cell(created_at_updated_at)="data"
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
        <template #cell(options)="data">
          <div>
            <a
              v-if="haveAccess('Delete SubjectRegistration')||haveElementAccess('Delete SubjectRegistration Owner',data.item.created_by_id)"
              class="ml-1 text-danger"
              @click="Delete(data.item.id)"
            >
              <font-awesome-icon
                :icon="['fas', 'trash']"
              />
            </a>
          </div>
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
  name: 'SubjectRegistrationList',
  data() {
    return {
      selected_year: undefined,
      perPage: 5,
      currentPage: 1,
      filter: null,
      errors: [],
      deleteElement: false,
      element: null,
    }
  },
  computed: {
    years() {
      return this.$store.getters['year/GetElements']
      // let a = []
      // if (this.items.length > 0) {
      //   a = Array.from(new Set(this.items.map(item => item.year)))
      //   this.changeYear(a)
      // }
      // return a
    },
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'subject', label: this.$t('subject') },
        { key: 'class_level', label: this.$t('class level') },
        { key: 'classroom', label: this.$t('classroom') },
        { key: 'year', label: this.$t('year') },
        { key: 'percentage', label: this.$t('percentage') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    items() {
      return this.Teacher.subject_registrations
    },
    yearly_items() {
      if (this.selected_year) return this.items.filter(el => el.year === this.selected_year)
      return this.items
    },
    Teacher() {
      return this.$store.getters['teacher/GetTeacher']
    },
    totalRows() {
      return this.items.length
    },
  },
  watch: {
    years() {
      this.selected_year = this.years[this.years.length - 1].name
    },
  },
  created() {
    this.$store.dispatch('year/GetElements')
  },
  methods: {
    changeYear(val) {
      this.selected_year = val[val.length - 1]
    },
    Delete(val) {
      this.deleteElement = true
      this.element = val
    },
    ConfirmDelete() {
      this.$store.dispatch('subjectRegistration/Delete', this.element).then(() => {
        this.$store.dispatch('teacher/GetTeacher', this.$route.params.teacher)
      })
    },
  },
}
</script>
