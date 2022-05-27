<template>
  <div>
    <b-modal
      v-model="deleteElement"
      :title="$t('Delete Menu')"
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
        {{ $t('are you sure you want to delete this Menu') }}
      </b-badge>
    </b-modal>
    <h3 class="mb-3">
      {{ $t('Menus') }}
    </h3>
    <b-row>
      <b-col cols="6">
        <b-button
          v-if="haveAccess('Create Menu')"
          variant="gradient-success"
          @click="$router.push({name:'menu.create'})"
        >
          {{ $t('Create new') }}
        </b-button>
      </b-col>
      <b-col
        cols="6"
        class="d-flex justify-content-end"
      >
        <b-button
          v-if="haveAccess(['Show Menu Trash','Show Menu Trash Owner'])"
          variant="gradient-danger"
          @click="$router.push({name:'menu.trashed'})"
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
              {{ $t('Menus') }}
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
        <template #cell(title)="data">
          {{ data.item.title }}
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
        </template>        <template #cell(type)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(post)="data">
          <b-badge
            pill
            :variant="data.item.post_data?'light-primary':'light-danger'"
          >
            {{ data.item.post_data?data.item.post_data.name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(page)="data">
          <b-badge
            pill
            :variant="data.item.page_data?'light-primary':'light-danger'"
          >
            {{ data.item.page_data?data.item.page_data.name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(project)="data">
          <b-badge
            pill
            :variant="data.item.project_data?'light-primary':'light-danger'"
          >
            {{ data.item.project_data?data.item.project_data.name:$t('Not related yet') }}
          </b-badge>
        </template>

        <template #cell(options)="data">
          <div class="w-max">
            <router-link
              v-if="haveAccess('Update Menu')||haveElementAccess('Update Menu Owner',data.item.created_by_id)"
              class="text-success"
              :to="{name:'menu.edit',params: { menu: data.item.id }}"
            >
              <font-awesome-icon
                :icon="['fas', 'edit']"
              />
            </router-link>
            <a
              v-if="haveAccess('Delete Menu')||haveElementAccess('Delete Menu Owner',data.item.created_by_id)"
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
    <explain />
  </div>
</template>

<script>

export default {
  data() {
    return {
      deleteElement: false,
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
        { key: 'title', label: this.$t('title') },
        { key: 'type', label: this.$t('type') },
        { key: 'url', label: this.$t('url') },
        { key: 'post', label: this.$t('post') },
        { key: 'page', label: this.$t('page') },
        { key: 'project', label: this.$t('project') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    items() {
      return this.$store.getters['menu/GetElements']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('menu/GetElements')
  },
  methods: {
    Delete(val) {
      this.deleteElement = true
      this.element = val
    },
    ConfirmDelete() {
      this.$store.dispatch('menu/Delete', this.element)
    },
  },
}
</script>
