<template>
  <div>

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
          v-if="haveAccess('Delete Role')"
          cols="6"
          md="3"
          class="mb-1"
        >

          <b-badge variant="light-danger">
            <font-awesome-icon
              :icon="['fas', 'trash']"
            />
            {{ $t('Delete') }}
          </b-badge>
        </b-col>
        <b-col
          v-if="haveAccess('Update Role')"
          cols="6"
          md="3"
          class="mb-1"
        >
          <b-badge variant="light-success">
            <font-awesome-icon
              :icon="['fas', 'edit']"
            />
            {{ $t('Edit') }}
          </b-badge>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'RoleExp',
}
</script>

<style lang="scss">
</style>
