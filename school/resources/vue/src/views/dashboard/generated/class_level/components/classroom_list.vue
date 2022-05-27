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
      <b-badge
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to delete this Classroom') }}
      </b-badge>
    </b-modal>
    <b-card>
      <b-card-title>
        <h3>
          {{ $t('Classrooms') }}
        </h3>
      </b-card-title>
      <b-row class="mb-3">
        <b-col cols="6">
          <v-select
            v-model="selected_year"
            :options="years"
            :reduce="years => years.name"
            label="name"
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
        <template
          #cell(created_at_updated_at)="data"
        >
          <div>
            <b-badge
              v-if="data.item.created_at"
              v-b-tooltip.hover="{title:data.item.created_at,variant:'success',placement:'top'}"
              variant="light-success"
            >
              <font-awesome-icon
                :icon="['fas', 'table']"
              />
              {{ data.item.created_from }}
            </b-badge>
            <b-badge
              v-if="data.item.updated_from"
              v-b-tooltip.hover="{ title:data.item.updated_from,variant:'warning',placement:'top'}"
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
        <template #cell(class_level)="data">
          <b-badge
            pill
            :variant="data.item.class_level_name?'light-primary':'light-danger'"
          >
            {{ data.item.class_level_name?data.item.class_level_name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(year)="data">
          <b-badge
            pill
            :variant="data.item.class_level_data?'light-primary':'light-danger'"
          >
            {{ data.item.year?data.item.year.name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(subject_registrations)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item['subject_registrations_count'] }}
          </b-badge>
        </template>
        <template #cell(notifications)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item['notifications_count'] }}
          </b-badge>
        </template>

        <template #cell(options)="data">
          <div class="w-max">
            <router-link
              v-if="haveAccess('Update Classroom')||haveElementAccess('Update Classroom Owner',data.item.created_by_id)"
              class="text-success"
              :to="{name:'classroom.edit',params: { classroom: data.item.id }}"
            >
              <font-awesome-icon
                :icon="['fas', 'eye']"
              />
            </router-link>
            <a
              v-if="haveAccess('Delete Classroom')||haveElementAccess('Delete Classroom Owner',data.item.created_by_id)"
              class="ml-2 text-danger"
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
  name: 'ClassroomList',
  data() {
    return {
      deleteElement: false,
      selected_year: undefined,
      element: null,
      filter: null,
      perPage: 5,
      currentPage: 1,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'name', label: this.$t('name') },
        { key: 'class_level', label: this.$t('class_level') },
        { key: 'year', label: this.$t('year') },
        { key: 'subject_registrations', label: this.$t('subject_registrations') },
        { key: 'notifications', label: this.$t('notifications') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    years() {
      return this.$store.getters['year/GetElements']
      // let a = []
      // if (this.items.length > 0) {
      //   a = Array.from(new Set(this.items.map(item => item.year.name)))
      //   this.changeYear(a)
      // }
      // return a
    },
    items() {
      return this.$store.getters['classLevel/GetElement'].class_rooms
    },
    yearly_items() {
      if (this.items) {
        if (this.selected_year) return this.items.filter(el => el.year.name === this.selected_year)
      }
      return this.items
    },
    totalRows() {
      return this.$store.getters['classLevel/GetElement'].class_rooms.length
    },
  },

  watch: {
    years() {
      this.selected_year = this.years[this.years.length - 1].name
    },
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
      this.$store.dispatch('classroom/Delete', { element: this.element, class_level: this.$route.params.class_level })
    },
  },
}
</script>
