<template>
  <div>
    <b-modal
      v-model="changeChatStatus"
      :title="$t('Change Chat Status')"
      no-close-on-backdrop
      hide-footer
    >
      <b-row>
        <b-col cols="12">
          {{ $t('Are you sure you want to change chat status') }}
        </b-col>
        <b-col
          cols="12"
          class="mt-2 d-flex justify-content-end"
        >
          <b-button
            class="mr-1"
            variant="success"
            @click="ChangeStatus()"
          >
            {{ $t('Confirm') }}
          </b-button>
          <b-button
            variant="danger"
            @click="CloseChangeStatus()"
          >
            {{ $t('Cancel') }}
          </b-button>
        </b-col>
      </b-row>
    </b-modal>
    <b-card>
      <b-row class="mb-2">
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
            {{ data.item.id }}
          </b-badge>
        </template>
        <template #cell()="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(subject_name)="data">
          <b-badge
            pill
            variant="light-success"
          >
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(semester_name)="data">
          <b-badge
            pill
            variant="light-info"
          >
            {{ $t(data.value) }}
          </b-badge>
        </template>
        <template #cell(chat_status)="data">
          <b-badge
            v-if="data.value===0"
            pill
            variant="light-info"
          >
            {{ $t('Only me') }}
          </b-badge>
          <b-badge
            v-else
            pill
            variant="light-info"
          >
            {{ $t('Active for all') }}
          </b-badge>
        </template>
        <template #cell(options)="data">
          <div class="w-max">
            <a
              v-if="data.item.chat_status===0"
              v-b-tooltip.hover.v-danger
              :title="$t('Deactivate')"
              class="text-success"
              @click="ChangeChatStatus(data.item.id)"
            >
              <font-awesome-icon
                :icon="['fas', 'comment']"
              />
            </a>
            <a
              v-else
              v-b-tooltip.hover.v-success
              :title="$t('Activate')"
              class="text-danger"
              @click="ChangeChatStatus(data.item.id)"
            >
              <font-awesome-icon
                :icon="['fas', 'comment-slash']"
              />
            </a>
            <router-link
              class="text-success ml-1"
              :to="{name:'tcp.subject-info',params: { subject_registration: data.item.id }}"
            >
              <font-awesome-icon
                :icon="['fas', 'eye']"
              />
            </router-link>
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
          class="d-flex justify-content-end mt-1"
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
  data() {
    return {
      changeChatStatus: false,
      subject: null,
      perPage: 5,
      currentPage: 1,
      filter: null,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'subject_name', label: this.$t('subject_name') },
        { key: 'semester_name', label: this.$t('semester_name') },
        { key: 'class_level_name', label: this.$t('class_level_name') },
        { key: 'classroom_name', label: this.$t('classroom_name') },
        { key: 'chat_status', label: this.$t('chat_status') },
        { key: 'options', label: this.$t('Options') },
      ]
    },
    items() {
      return this.$store.getters['tcp/SubjectRegistrations']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('tcp/GetSubjectRegistrations')
  },
  methods: {
    ChangeStatus() {
      this.$store.dispatch('tcp/ChangeChatStatus', this.subject).then(() => {
        this.changeChatStatus = false
      })
    },
    CloseChangeStatus() {
      this.changeChatStatus = false
    },
    ChangeChatStatus(val) {
      this.subject = val
      this.changeChatStatus = true
    },
  },
}
</script>

<style>

</style>
