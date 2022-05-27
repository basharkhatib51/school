<template>
  <div>
    <b-modal
      v-model="deleteElement"
      :title="$t('Delete Page')"
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
        {{ $t('are you sure you want to delete this Page') }}
      </b-badge>
    </b-modal>
    <h3 class="mb-3">
      {{ $t('Pages') }}
    </h3>
    <b-row>
      <b-col cols="6">
        <b-button
          v-if="haveAccess('Create Page')"
          variant="gradient-success"
          @click="$router.push({name:'page.create'})"
        >
          {{ $t('Create new') }}
        </b-button>
      </b-col>
      <b-col
        cols="6"
        class="d-flex justify-content-end"
      >
        <b-button
          v-if="haveAccess(['Show Page Trash','Show Page Trash Owner'])"
          variant="gradient-danger"
          @click="$router.push({name:'page.trashed'})"
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
              {{ $t('Pages') }}
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
        <template #cell(excerpt)="data">
          {{ data.item.excerpt }}
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
        <template #cell(image)="data">
          <b-avatar
            :src="`${ data.item.image_data ? $fullPath + data.item.image_data.url:''}`"
          />
        </template>
        <template #cell(background)="data">
          <b-avatar
            :src="`${ data.item.background_data ? $fullPath + data.item.background_data.url:''}`"
          />
        </template>
        <template #cell(layout)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(status)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.value }}
          </b-badge>
        </template>
        <template #cell(slider)="data">
          <b-badge
            pill
            :variant="data.item.slider_data?'light-primary':'light-danger'"
          >
            {{ data.item.slider_data?data.item.slider_data.name:$t('Not related yet') }}
          </b-badge>
        </template>
        <template #cell(tags)="data">
          <b-badge
            pill
            variant="light-primary"
          >
            {{ data.item['tags_count'] }} Tags
          </b-badge>
        </template>

        <template #cell(options)="data">
          <div class="w-max">
            <router-link
              v-if="haveAccess('Update Page')||haveElementAccess('Update Page Owner',data.item.created_by_id)"
              class="text-success"
              :to="{name:'page.edit',params: { page: data.item.id }}"
            >
              <font-awesome-icon
                :icon="['fas', 'edit']"
              />
            </router-link>
            <a
              v-if="haveAccess('Delete Page')||haveElementAccess('Delete Page Owner',data.item.created_by_id)"
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
        { key: 'image', label: this.$t('image') },
        { key: 'excerpt', label: this.$t('excerpt') },
        { key: 'layout', label: this.$t('layout') },
        { key: 'status', label: this.$t('status') },
        { key: 'slider', label: this.$t('slider') },
        { key: 'tags', label: this.$t('tags') },
        { key: 'created_at_updated_at', label: this.$t('created_at_updated_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
    items() {
      return this.$store.getters['page/GetElements']
    },
    totalRows() {
      return this.items.length
    },
  },
  created() {
    this.$store.dispatch('page/GetElements')
  },
  methods: {
    Delete(val) {
      this.deleteElement = true
      this.element = val
    },
    ConfirmDelete() {
      this.$store.dispatch('page/Delete', this.element)
    },
  },
}
</script>
