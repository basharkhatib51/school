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
          v-if="haveAccess(['Change Admin Password','Change Admin Password Owner'])"
          cols="6"
          md="3"
          class="mb-1"
        >
          <b-badge variant="light-warning">
            <font-awesome-icon
              :icon="['fas', 'key']"
            />
            {{ $t('Change Password') }}
          </b-badge>
        </b-col>
        <b-col
          v-if="haveAccess(['Delete Admin','Delete Admin Owner'])"
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
          v-if="haveAccess(['Update Admin','Update Admin Owner'])"
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
        <b-col
          v-if="haveAccess(['Change Admin Role','Change Admin Role Owner'])"
          cols="6"
          md="3"
          class="mb-1"
        >
          <b-badge variant="light-info">
            <font-awesome-icon
              :icon="['fas', 'user-shield']"
            />
            {{ $t('Change Role') }}
          </b-badge>
        </b-col>
        <b-col
          v-if="haveAccess(['Change Admin Status','Change Admin Status Owner'])"
          cols="6"
          md="3"
          class="mb-1"
        >
          <b-badge variant="light-primary">
            <font-awesome-icon
              :icon="['fas', 'toggle-off']"
            />
            {{ $t('Change Status') }}
          </b-badge>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'AdminExp',
}
</script>

<style lang="scss">
</style>
