<template>
  <div>
    <b-card
      :title="$t('Create New Subject')"
    >
      <b-row>
        <b-col
          cols="12"
        >
          <div class="form-label-group">
            <b-form-input
              v-model="data.name"
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
        </b-col>
        <b-col
          cols="12"
        >
          <div class="form-label-group">
            <b-form-input
              v-model="data.percentage"
              class="mt-2"
              type="number"
              :state="errors.percentage ?false:null"
              :placeholder="$t('Percentage')"
            />
            <small
              v-if="errors.percentage"
              class="text-danger"
            >{{ errors.percentage[0] }}</small>
            <label>{{ $t('Percentage') }}</label>
          </div>
        </b-col>
        <b-col
          cols="12"
        >
          <div>
            <label>{{ $t('Semester') }}</label>
            <v-select
              v-model="data.semester"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              label="value"
              :reduce="semesters=>semesters.key"
              :options="semesters"
            />
            <small
              v-if="errors.semester"
              class="text-danger"
            >{{ errors.semester[0] }}</small>
          </div>
        </b-col>
        <b-col cols="12">
          <b-button
            class="w-100 mt-1"
            variant="success"
            @click="create"
          >
            {{ $t('Create') }}
          </b-button>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
export default {
  name: 'CreateSubject',
  data() {
    return {
      data: {
        name: '', semester: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    semesters() {
      return [{ key: 'first', value: this.$t('first') }, { key: 'second', value: this.$t('second') }]
    },
  },
  created() {
    this.$store.dispatch('classLevel/GetElements')
  },
  methods: {
    resetData() {
      this.data = {
        name: '', semester: '', percentage: null,
      }
      this.errors = []
    },
    setBoolean(val) {
      if (this.data[val] === undefined) { this.data[val] = false }
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    create() {
      this.errors = []
      this.data.class_level = this.$route.params.class_level
      this.$store.dispatch('subject/Create', this.data).then(() => {
        this.data = {
          name: '', semester: '', percentage: null,
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
