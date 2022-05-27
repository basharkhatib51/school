<template>
  <div>
    <b-row>
      <b-col cols="12">
        <b-card
          v-if="SubjectRegistrations"
          :title="$t('Subject information')"
        >
          <b-row class="d-flex justify-content-around">
            <b-col
              cols="12"
              md="2"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'layer-group']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ SubjectRegistrations.class_level_name }}
              </h5>
            </b-col>
            <b-col
              cols="12"
              md="2"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'door-closed']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ SubjectRegistrations.classroom_name }}
              </h5>
            </b-col>
            <b-col
              cols="12"
              md="2"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'adjust']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ $t(SubjectRegistrations.semester_name) }}
              </h5>
            </b-col>
            <b-col
              cols="12"
              md="2"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'book']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ SubjectRegistrations.subject_name }}
              </h5>
            </b-col>
            <b-col
              v-if="SubjectRegistrations.subject_data"
              cols="12"
              md="2"
              class="text-center mt-1"
            >
              <font-awesome-icon
                class="text-primary"
                :icon="['fas', 'font']"
                size="2x"
              />
              <h5 class="mt-1">
                {{ SubjectRegistrations.subject_data.percentage }}
              </h5>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>

export default {
  name: 'SubjectRegistrationInfo',
  computed: {
    SubjectRegistrations() { return this.$store.getters['subjectRegistration/GetElement'].subject_registrations },
  },
}
</script>

<style>

</style>
