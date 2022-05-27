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
    <b-card>
      <b-card-title>
        <b-row>
          <b-col cols="8">
            <h3>
              {{ $t('Subject Registration') }}
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
      <b-row class="mb-2">
        <b-col
          cols="12"
          class="d-flex justify-content-end"
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
        v-if="items.length>0"
        :fields="fields"
        responsive="sm"
        :items="items"
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
        <template #cell(subject)="data">
          <div>
            {{ data.item.subject_name }}
          </div>
        </template>
        <template #cell(contact)="data">
          <div>

            <div
              v-if="data.item.teacher_data.email"
              v-b-tooltip.hover="{title:'Press to send email',variant:'primary',placement:'top'}"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'envelope']"
              />
              <a :href="'mailto:'+data.item.teacher_data.email">
                {{ data.item.teacher_data.email }}
              </a>
            </div>
            <div
              v-if="data.item.teacher_data.phone"
              v-b-tooltip.hover="{title:'Press to make call',variant:'primary',placement:'top'}"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'phone']"
              />
              <a :href="'tel:'+data.item.teacher_data.phone">
                {{ data.item.teacher_data.phone }}
              </a>
            </div>
          </div>
        </template>
        <template #cell(semester)="data">
          {{ $t(data.item.semester_name) }}
        </template>

        <template #cell(teacher)="data">

          {{ data.item.teacher_data.first_name }}
          {{ data.item.teacher_data.last_name }}
        </template>
        <template #cell(options)="data">
          <div>
            <router-link
              class="text-success mr-1"
              :to="{name:'subject_registration.edit',params: { subject_registration: data.item.id }}"
            >
              <font-awesome-icon
                :icon="['fas', 'eye']"
              />
            </router-link>
            <a
              v-if="haveAccess('Delete SubjectRegistration')||haveElementAccess('Delete SubjectRegistration Owner',data.item.created_by_id)"
              class="text-danger"
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
  name: 'SubjectRegistrationsList',
  data() {
    return {
      teacher: null,
      perPage: 5,
      deleteElement: false,
      element: null,
      currentPage: 1,
      filter: null,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'subject', label: this.$t('subject') },
        { key: 'semester', label: this.$t('semester') },
        { key: 'teacher', label: this.$t('teacher') },
        { key: 'contact', label: this.$t('contact') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    items() {
      return this.$store.getters['classroom/GetElement'].subject_registrations
    },
    totalRows() {
      return this.items.length
    },
  },
  methods: {
    Delete(val) {
      this.deleteElement = true
      this.element = val
    },
    ConfirmDelete() {
      this.$store.dispatch('subjectRegistration/Delete', this.element).then(() => {
        this.$store.dispatch('classroom/GetElement', this.$route.params.classroom)
      })
    },
  },
}
</script>

<style>

</style>
