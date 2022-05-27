<template>
  <div>
    <change-status
      v-model="changeStatus"
      :student="student"
    />
    <change-password
      v-model="changePassword"
      :student="student"
    />
    <b-modal
      v-model="deleteStudent"
      :title="$t('Delete Student')"
      :ok-title="$t('Delete')"
      :cancel-title="$t('cancel')"
      ok-variant="danger"
      cancel-variant="primary"
      @close="deleteStudent=false"
      @cancel="deleteStudent=false"
      @ok="ConfirmDelete"
    >
      <b-badge
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to delete this Student') }}
      </b-badge>
    </b-modal>
    <h3 class="mb-3">
      {{ $t('Students') }}
    </h3>
    <b-row>
      <b-col cols="6">
        <b-button
          v-if="haveAccess('Create Student')"
          variant="gradient-success"
          @click="$router.push({name:'student.create'})"
        >
          {{ $t('Create new') }}
        </b-button>
      </b-col>
      <b-col
        cols="6"
        class="d-flex justify-content-end"
      >
        <b-button
          v-if="haveAccess(['Show Student Trash','Show Student Trash Owner'])"
          variant="gradient-danger"
          @click="$router.push({name:'student.trashed'})"
        >
          <font-awesome-icon
            :icon="['fas', 'trash']"
          />
          {{ $t('Trashed') }}
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
            {{ data.item.no }}
          </b-badge>
        </template>
        <template #cell(model_number)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            <font-awesome-icon
              class="text-primary"
              :icon="['fas', 'user-graduate']"
            />
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(avatar)="data">
          <b-avatar
            :src="`${$fullPath}/${data.value}`"
          />
        </template>
        <template #cell(class)="data">
          <b-badge
            v-if="!data.item.current_student_registration"
            variant="light-danger"
          >
            {{ $t('Not registered in new year') }}
          </b-badge>
          <b-badge
            v-else
            variant="light-success"
          >
            {{ data.item.current_student_registration.class_level_name }} / {{ data.item.current_student_registration.classroom_name }}
          </b-badge>
        </template>
        <template #cell(name)="data">
          <div>
            <font-awesome-icon
              class="text-primary"
              :icon="['fas', 'id-card']"
            />
            {{ data.item.first_name }}
            {{ data.item.last_name }}
          </div>
        </template>
        <template #cell(contact)="data">
          <div>
            <div
              v-if="data.item.email"
              v-b-tooltip.hover="{title:'Press to send email',variant:'primary',placement:'top'}"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'envelope']"
              />
              <a :href="'mailto:'+data.item.email">
                {{ data.item.email }}
              </a>
            </div>
            <div
              v-if="data.item.phone"
              v-b-tooltip.hover="{title:'Press to make call',variant:'primary',placement:'top'}"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'phone']"
              />
              <a :href="'tel:'+data.item.phone">
                {{ data.item.phone }}
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
              v-if="haveAccess('Update Student')||haveElementAccess('Update Student Owner',data.item.created_by_id)"
              class="text-success"
              :to="{name:'student.edit',params: { student: data.item.id }}"
            >
              <font-awesome-icon
                :icon="['fas', 'eye']"
              />
            </router-link>
            <a
              v-if="haveAccess('Delete Student')||haveElementAccess('Delete Student Owner',data.item.created_by_id)"
              class="ml-1 text-danger"
              @click="Delete(data.item.id)"
            >
              <font-awesome-icon
                :icon="['fas', 'trash']"
              />
            </a>
            <a
              v-if="haveAccess('Change Student Password')||haveElementAccess('Change Student Password Owner',data.item.created_by_id)"
              class="ml-1 text-warning"
              @click="ChangePassword(data.item.id)"
            >
              <font-awesome-icon
                :icon="['fas', 'key']"
              />
            </a>
            <a
              v-if="haveAccess('Change Student Status')||haveElementAccess('Change Student Status Owner',data.item.created_by_id)"
              class="ml-1"
              @click="ChangeStatus(data.item.id)"
            >
              <font-awesome-icon
                v-b-tooltip.hover="{title:$t(data.item.status),variant:data.item.status==='active'?'success':'danger',placement:'top'}"
                :class="(data.item.status==='active'?'text-success':'text-danger')"
                :icon="['fas', (data.item.status==='active'?'toggle-on':'toggle-off')]"
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
    <student-exp />
  </div>
</template>

<script>

import ChangeStatus from '@/views/dashboard/student/components/change_status.vue'
import ChangePassword from '@/views/dashboard/student/components/change_password.vue'
import StudentExp from '@/views/dashboard/components/user_explain.vue'

export default {
  components: {
    StudentExp, ChangePassword, ChangeStatus,
  },
  data() {
    return {
      deleteStudent: false,
      changeStatus: false,
      changePassword: false,
      changeRole: false,
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
        { key: 'avatar', label: this.$t('avatar') },
        { key: 'name', label: this.$t('name') },
        { key: 'contact', label: this.$t('contact') },
        { key: 'class', label: this.$t('class') },
        { key: 'model_number', label: this.$t('student number') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    auth() {
      return this.$store.getters['auth/GetAuth']
    },
    items() {
      return this.$store.getters['student/GetStudents']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('student/GetStudents')
  },
  methods: {
    Delete(val) {
      this.deleteStudent = true
      this.student = val
    },
    ConfirmDelete() {
      this.$store.dispatch('student/Delete', this.student)
    },
    ChangeStatus(val) {
      this.student = val
      this.changeStatus = true
    },
    ChangePassword(val) {
      this.changePassword = true
      this.student = val
    },
  },
}
</script>

<style>

</style>
