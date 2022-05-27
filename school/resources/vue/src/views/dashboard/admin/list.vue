<template>
  <div>
    <change-status
      v-model="changeStatus"
      :admin="admin"
    />
    <change-password
      v-model="changePassword"
      :admin="admin"
    />
    <!--    <change-role-->
    <!--      v-model="changeRole"-->
    <!--      :admin="admin"-->
    <!--    />-->
    <b-modal
      v-model="deleteAdmin"
      :title="$t('Delete Admin')"
      :ok-title="$t('Delete')"
      :cancel-title="$t('cancel')"
      ok-variant="danger"
      cancel-variant="primary"
      @close="deleteAdmin=false"
      @cancel="deleteAdmin=false"
      @ok="ConfirmDelete"
    >
      <b-badge
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to delete this Admin') }}
      </b-badge>
    </b-modal>
    <h3 class="mb-3">
      {{ $t('Admins') }}
    </h3>
    <b-row>
      <b-col cols="6">
        <b-button
          v-if="haveAccess('Create Admin')"
          variant="gradient-success"
          @click="$router.push({name:'admin.create'})"
        >
          {{ $t('Create new') }}
        </b-button>
      </b-col>
      <b-col
        cols="6"
        class="d-flex justify-content-end"
      >
        <b-button
          v-if="haveAccess(['Show Admin Trash','Show Admin Trash Owner'])"
          variant="gradient-danger"
          @click="$router.push({name:'admin.trashed'})"
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
              {{ $t('Admins') }}
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
        <template #cell(avatar)="data">
          <b-avatar
            :src="`${$fullPath}/${data.value}`"
          />
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
              v-b-tooltip.hover="{title:$t('Press to send email'),variant:'primary',placement:'top'}"
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
        <template #cell(role)="data">
          <b-button variant="outline-primary">
            <font-awesome-icon
              class="mr-1"
              :icon="['fas', 'key']"
            />
            <span v-if="data.value">
              {{ data.value.name }}
            </span>
            <span v-else>
              No Roles Yet
            </span>
            <b-badge
              v-if=" data.value"
              class="badge-glow ml-1"
              pill
              variant="primary"
            >
              {{ data.value.permissions.length }}
            </b-badge>
          </b-button>
        </template>
        <template #cell(options)="data">
          <div>
            <router-link
              v-if="haveAccess('Update Admin')||haveElementAccess('Update Admin Owner',data.item.created_by_id)"
              class="text-success"
              :to="{name:'admin.edit',params: { admin: data.item.id }}"
            >
              <font-awesome-icon
                :icon="['fas', 'edit']"
              />
            </router-link>
            <a
              v-if="haveAccess('Delete Admin')||haveElementAccess('Delete Admin Owner',data.item.created_by_id)"
              class="ml-1 text-danger"
              @click="Delete(data.item.id)"
            >

              <font-awesome-icon
                :icon="['fas', 'trash']"
              />
            </a>
            <a
              v-if="haveAccess('Change Admin Password')||haveElementAccess('Change Admin Password Owner',data.item.created_by_id)"
              class="ml-1 text-warning"
              @click="ChangePassword(data.item.id)"
            >
              <font-awesome-icon
                :icon="['fas', 'key']"
              />
            </a>
            <a
              v-if="haveAccess('Change Admin Status')||haveElementAccess('Change Admin Status Owner',data.item.created_by_id)"
              class="ml-1"
              @click="ChangeStatus(data.item.id)"
            >
              <font-awesome-icon
                v-b-tooltip.hover="{title:$t(data.item.status),variant:data.item.status==='active'?'success':'danger',placement:'top'}"
                :class="(data.item.status==='active'?'text-success':'text-danger')"
                :icon="['fas', (data.item.status==='active'?'toggle-on':'toggle-off')]"
              />
            </a>
            <!--            <a-->
            <!--              v-if="haveAccess('Change Admin Role')||haveElementAccess('Change Admin Role Owner',data.item.created_by_id)"-->
            <!--              class="ml-1 text-info"-->
            <!--              @click="ChangeRole(data.item.id)"-->
            <!--            >-->
            <!--              <font-awesome-icon-->
            <!--                :icon="['fas', 'user-shield']"-->
            <!--              />-->
            <!--            </a>-->
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
    <admin-exp />
  </div>
</template>

<script>

import ChangeStatus from '@/views/dashboard/components/change_status.vue'
import ChangePassword from '@/views/dashboard/components/change_password.vue'
import AdminExp from '@/views/dashboard/components/user_explain.vue'
// import ChangeRole from '@/views/dashboard/components/change_role.vue'

export default {
  components: {
    AdminExp, ChangePassword, ChangeStatus,
  },
  data() {
    return {
      deleteAdmin: false,
      changeStatus: false,
      changePassword: false,
      // changeRole: false,
      admin: null,
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
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'role', label: this.$t('role') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    auth() {
      return this.$store.getters['auth/GetAuth']
    },
    items() {
      return this.$store.getters['admin/GetAdmins']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('admin/GetAdmins')
  },
  methods: {
    Delete(val) {
      this.deleteAdmin = true
      this.admin = val
    },
    ConfirmDelete() {
      this.$store.dispatch('admin/Delete', this.admin)
    },
    ChangeStatus(val) {
      this.admin = val
      this.changeStatus = true
    },
    // ChangeRole(val) {
    //   this.admin = val
    //   this.changeRole = true
    // },
    ChangePassword(val) {
      this.changePassword = true
      this.admin = val
    },
  },
}
</script>

<style>

</style>
