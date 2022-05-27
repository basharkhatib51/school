<template>
  <div>

    <b-modal
      v-model="deleteRole"
      :title="$t('Delete Role')"
      :ok-title="$t('Delete')"
      :cancel-title="$t('cancel')"
      ok-variant="danger"
      cancel-variant="primary"
      @close="deleteRole=false"
      @cancel="deleteRole=false"
      @ok="ConfirmDelete"
    >
      <b-badge
        class="mt-1"
        variant="light-danger"
      >
        {{ $t('are you sure you want to delete this role') }}
      </b-badge>
    </b-modal>
    <create-role v-model="newRole" />
    <edit-role
      v-model="editRole"
      :role="role"
    />
    <permissions
      v-model="PermissionList"
      :role="role"
    />
    <h3 class="mb-3">
      {{ $t('Roles') }}
    </h3>
    <b-row>
      <b-col cols="12">
        <b-button
          v-if="haveAccess('Create Role')"
          variant="gradient-success"
          @click="newRole=true"
        >
          {{ $t('Create new') }}
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
              {{ $t('Roles') }}
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
        v-if="roles.length>0"
        responsive="sm"
        :items="roles"
        :filter="filter"
        :per-page="perPage"
        :fields="fields"
        :current-page="currentPage"
      >

        <template #cell(id)="data">
          <b-badge variant="light-primary">
            {{ data.item.no }}
          </b-badge>
        </template>
        <template #cell(name)="data">
          <span class="text-primary">
            {{ data.value }}
          </span>
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
        <template #cell(permissions)="data">
          <b-button
            variant="outline-primary"
            @click="ViewPermissions(data.item.id)"
          >
            <font-awesome-icon
              :icon="['fas', 'key']"
            />
            {{ data.value.length }}
          </b-button>
        </template>
        <template #cell(options)="data">
          <div class="w-max">
            <a
              v-if="haveAccess('Update Role')"
              class="text-success"
              @click="Edit(data.item.id)"
            >
              <font-awesome-icon
                :icon="['fas', 'edit']"
              />
            </a>
            <a
              v-if="haveAccess('Delete Role')"
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
    <role-exp />
  </div>
</template>

<script>

import EditRole from '@/views/dashboard/role/components/edit.vue'
import CreateRole from '@/views/dashboard/role/components/create.vue'
import RoleExp from '@/views/dashboard/role/components/explain.vue'
import Permissions from '@/views/dashboard/role/components/permission.vue'

export default {
  components: {
    Permissions, RoleExp, CreateRole, EditRole,
  },
  data() {
    return {
      role: null,
      filter: null,
      newRole: false,
      PermissionList: false,
      editRole: false,
      deleteRole: false,
      perPage: 5,
      currentPage: 1,
    }
  },
  computed: {
    fields() {
      return [
        { key: 'id', label: this.$t('id') },
        { key: 'name', label: this.$t('name') },
        { key: 'permissions', label: this.$t('permissions') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    totalRows() {
      return this.roles.length
    },
    roles() {
      return this.$store.getters['role/Roles']
    },
  },
  created() {
    this.$store.dispatch('role/GetRoles')
  },
  methods: {
    Delete(val) {
      this.deleteRole = true
      this.role = val
    },
    ConfirmDelete() {
      this.$store.dispatch('role/Delete', this.role)
    },
    Edit(val) {
      this.editRole = true
      this.role = val
    },
    ViewPermissions(val) {
      this.PermissionList = true
      this.role = val
    },
  },
}
</script>

<style>

</style>
