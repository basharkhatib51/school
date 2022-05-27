<template>
  <div>
    <b-card>
      <b-card-title>
        <b-row>
          <b-col cols="8">
            <h3>
              {{ $t('Students') }}
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
            {{ data.item.student_no }}
          </b-badge>
        </template>
        <template #cell(name)="data">
          <div>
            <font-awesome-icon
              class="text-primary"
              :icon="['fas', 'id-card']"
            />
            {{ data.item.student_data.first_name }}
            {{ data.item.student_data.last_name }}
          </div>
        </template>
        <template #cell(contact)="data">
          <div>

            <div
              v-if="data.item.student_data.email"
              v-b-tooltip.hover="{title:'Press to send email',variant:'primary',placement:'top'}"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'envelope']"
              />
              <a :href="'mailto:'+data.item.student_data.email">
                {{ data.item.student_data.email }}
              </a>
            </div>
            <div
              v-if="data.item.student_data.phone"
              v-b-tooltip.hover="{title:'Press to make call',variant:'primary',placement:'top'}"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'phone']"
              />
              <a :href="'tel:'+data.item.student_data.phone">
                {{ data.item.student_data.phone }}
              </a>
            </div>
          </div>
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
            <router-link
              v-if="haveAccess('Update Student')||haveElementAccess('Update Student Owner',data.item.student_data.created_by_id)"
              class="text-success"
              :to="{name:'student.edit',params: { student: data.item.student_data.id }}"
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
  name: 'StudentList',
  data() {
    return {
      student: null,
      perPage: 5,
      currentPage: 1,
      filter: null,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'name', label: this.$t('name') },
        { key: 'contact', label: this.$t('contact') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    items() {
      return this.$store.getters['classroom/GetElement'].student_registrations
    },
    totalRows() {
      return this.items.length
    },
  },
}
</script>
