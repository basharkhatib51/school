<template>
  <div>
    <b-card :title="$t('Create Classroom')">
      <div class="form-label-group">
        <b-form-input
          v-model="ClassRoomData.name"
          class="mt-2"
          :state="errors.name ?false:null"
          :placeholder="$t('Name')"
        />
        <small
          v-if="errors.name"
          class="text-danger"
        >{{ errors.name[0] }}</small>
        <label>{{ $t('Name') }}</label>
      </div>
      <b-button
        class="w-100"
        variant="success"
        @click="create"
      >
        {{ $t('Create') }}
      </b-button>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'CreateClassroom',
  data() {
    return {
      ClassRoomData: {
        name: '',
      },
      errors: [],
    }
  },
  methods: {
    create() {
      this.ClassRoomData.class_level = this.$route.params.class_level
      this.errors = []
      this.$store.dispatch('classroom/Create', this.ClassRoomData).then(() => {
        this.ClassRoomData = {
          name: '',
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>

<style lang="scss">
</style>
