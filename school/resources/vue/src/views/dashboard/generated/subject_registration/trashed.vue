<template>
  <div>
    <b-modal
      v-model="restoreElement"
      :title="$t('Restore SubjectRegistration')"
      :ok-title="$t('Restore')"
      :cancel-title="$t('cancel')"
      ok-variant="success"
      cancel-variant="primary"
      @close="restoreElement=false"
      @cancel="restoreElement=false"
      @ok="ConfirmRestore"
    >
      <b-badge
        class="mt-1"
        variant="light-success"
      >
        {{ $t('are you sure you want to restore this SubjectRegistration') }}
      </b-badge>
    </b-modal>
    <h3 class="mb-3">
      {{ $t('SubjectRegistrations') }}
    </h3>
    <b-row>
      <b-col cols="12">
        <b-button
          variant="gradient-success"
          @click="$router.push({name:'subject_registration.list'})"
        >
          <font-awesome-icon
            :icon="['fas', 'arrow-left']"
          />
          {{ $t('SubjectRegistrations') }}
        </b-button>
      </b-col>
    </b-row>
    <b-card
      class="mt-5"
    >
      <b-card-title>
        <b-row>
          <b-col cols="8">
            <h3>
              {{ $t('SubjectRegistrations') }}
            </h3>
          </b-col>
          <b-col
            cols="4"
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
      </b-card-title>
      <b-table
        v-if="items.length>0"
        :fields="fields"
        responsive="sm"
        :filter="filter"
        :items="items"
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
          #cell(created_at_updated_at_deleted_at)="data"
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
            <b-badge
              v-b-tooltip.hover="{ title:data.item.deleted_at,variant:'danger',placement:'top'}"
              variant="light-danger"
              class="ml-1"
            >
              <font-awesome-icon
                :icon="['fas', 'calendar-times']"
              />
              {{ data.item.deleted_from }}
            </b-badge>
          </div>
        </template>        <template #cell(chat_status)="data">
          <b-badge
            pill
            :variant="data.value?'light-success':'light-danger'"
          >
            <font-awesome-icon
              :icon="['fas', data.value?'check':'times']"
            />
            {{ data.value?'true':'false' }}
          </b-badge>
        </template>
        <template #cell(subject)="data">
          <b-badge
            pill
            :variant="data.item.subject_data?'light-primary':'light-danger'"
          >
            {{ data.item.subject_data?data.item.subject_data.name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(classroom)="data">
          <b-badge
            pill
            :variant="data.item.classroom_data?'light-primary':'light-danger'"
          >
            {{ data.item.classroom_data?data.item.classroom_data.name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(teacher)="data">
          <b-badge
            pill
            :variant="data.item.teacher_data?'light-primary':'light-danger'"
          >
            {{ data.item.teacher_data?data.item.teacher_data.name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(year)="data">
          <b-badge
            pill
            :variant="data.item.year_data?'light-primary':'light-danger'"
          >
            {{ data.item.year_data?data.item.year_data.name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(exams)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item['exams_count'] }} Exams
          </b-badge>
        </template>
        <template #cell(messages)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item['messages_count'] }} Messages
          </b-badge>
        </template>
        <template #cell(programs)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item['programs_count'] }} Programs
          </b-badge>
        </template>

        <template #cell(options)="data">
          <div class="w-max">
            <a
              v-if="haveAccess('Restore SubjectRegistration')||haveElementAccess('Restore SubjectRegistration Owner',data.item.created_by_id)"
              class="ml-1 text-success"
              @click="RestoreSubjectRegistration(data.item.id)"
            >
              <font-awesome-icon
                :icon="['fas', 'trash-restore']"
              />
              {{ data.value }}
            </a>
            <b-badge
              v-else
              class="badge-glow ml-1"
              pill
              variant="danger"
            >
              {{ $t('there are no options') }}
            </b-badge>
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
    <b-card
      :title="$t('Explanations')"
      class="mt-5"
    >
      <b-row>
        <b-col
          cols="6"
          md="3"
          class="mb-1"
        >
          <b-badge variant="light-success">
            <font-awesome-icon
              :icon="['fas', 'table']"
            />
            {{ $t('Created At') }}
          </b-badge>
        </b-col>
        <b-col
          cols="6"
          md="3"
          class="mb-1"
        >
          <b-badge variant="light-warning">
            <font-awesome-icon
              :icon="['fas', 'calendar-week']"
            />
            {{ $t('Updated At') }}
          </b-badge>
        </b-col>
        <b-col
          cols="6"
          md="3"
          class="mb-1"
        >
          <b-badge variant="light-success">
            <font-awesome-icon
              :icon="['fas', 'trash-restore']"
            />
            {{ $t('Restore SubjectRegistration') }}
          </b-badge>
        </b-col>
        <b-col
          cols="6"
          md="3"
          class="mb-1"
        >
          <b-badge variant="light-danger">
            <font-awesome-icon
              :icon="['fas', 'calendar-times']"
            />
            {{ $t('Deleted At') }}
          </b-badge>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>
<script>
export default {
  components: {
  },
  data() {
    return {
      restoreElement: false,
      changeStatus: false,
      changePassword: false,
      perPage: 5,
      currentPage: 1,
      element: null,
      filter: null,
      fields: [
        'id',
        'chat_status',
        'subject',
        'classroom',
        'teacher',
        'year',
        'exams',
        'messages',
        'programs',
        'created_at_updated_at_deleted_at',
        'options',
      ],
    }
  },
  computed: {
    items() {
      return this.$store.getters['subjectRegistration/Trashed']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('subjectRegistration/GetTrashed')
  },
  methods: {
    RestoreSubjectRegistration(val) {
      this.restoreElement = true
      this.element = val
    },
    ConfirmRestore() {
      this.$store.dispatch('subjectRegistration/Restore', this.element)
    },
  },
}
</script>
