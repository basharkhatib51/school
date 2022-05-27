<template>
  <div>
    <b-tabs>
      <b-tab :title="$t('Classrooms')">
        <b-row>
          <b-col
            cols="12"
            md="6"
          >
            <create-classroom />
          </b-col>
          <b-col
            cols="12"
            md="6"
          >
            <b-card
              :title="$t('Edit ClassLevel')"
              border-variant="primary"
              bg-variant="light-primary"
            >
              <b-row>
                <b-col
                  cols="12"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="data.name"
                      :state="errors.name ?false:null"
                      :placeholder="$t('Name')"
                    />
                    <small
                      v-if="errors.name"
                      class="text-danger"
                    >{{ errors.name[0] }}</small>
                    <label>{{ $t('Name') }}</label>
                  </div>
                </b-col>
                <b-col cols="12">
                  <b-button
                    class="w-100"
                    variant="gradient-success"
                    @click="update"
                  >
                    {{ $t('Update') }}
                  </b-button>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
          <b-col cols="12">
            <classroom-list />
          </b-col>
        </b-row>
      </b-tab>
      <b-tab :title="$t('Subjects')">
        <b-col cols="12">
          <create-subject />
        </b-col>
        <b-col cols="12">
          <subject-list />
        </b-col>
      </b-tab>
    </b-tabs>
  </div>
</template>

<script>
import CreateClassroom from '@/views/dashboard/generated/class_level/components/create_classroom.vue'
import ClassroomList from '@/views/dashboard/generated/class_level/components/classroom_list.vue'
import CreateSubject from '@/views/dashboard/generated/class_level/components/create_subject.vue'
import SubjectList from '@/views/dashboard/generated/class_level/components/subject_list.vue'

export default {
  components: {
    SubjectList, CreateSubject, ClassroomList, CreateClassroom,
  },
  data() {
    return {
      data: {
        name: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    Element() {
      return this.$store.getters['classLevel/GetElement']
    },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.getData()
    this.$store.dispatch('year/GetElements')
  },
  methods: {
    resetData() {
      this.data = {
        name: '',
      }
      this.errors = []
    },
    setBoolean(val) {
      if (this.data[val] === undefined) {
        this.data[val] = false
      }
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    getData() {
      this.$store.dispatch('classLevel/GetElement', this.$route.params.class_level).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('classLevel/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
