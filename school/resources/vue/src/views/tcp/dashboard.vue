<template>
  <div>
    <h3>{{ $t('Statistics') }}</h3>
    <b-row class="mt-3">
      <b-col
        v-for="(val,index) in Subjects"
        :key="index"
        cols="12"
        sm="6"
        md="4"
        lg="3"
      >
        <b-card
          :title="val.subject_data.name"
          class="text-center"
        >
          <b-row>
            <b-col cols="12">
              <b-badge variant="light-success">
                {{ val.class_level_name }}
              </b-badge>
            </b-col>
            <b-col
              cols="12"
              class="mt-1"
            >
              <b-badge variant="light-success">
                {{ val.classroom_name }}
              </b-badge>
            </b-col>
            <b-col
              cols="12"
              class="mt-1"
            >
              <b-badge variant="light-primary">
                {{ $t(val.semester_name) }}
              </b-badge>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  components: {
  },
  data() {
    return {
      data: {
      },
    }
  },
  computed: {
    Subjects() {
      return this.$store.getters['tcp/SubjectRegistrations']
    },
  },
  created() {
    this.$store.dispatch('tcp/GetSubjectRegistrations')
  },
}
</script>
