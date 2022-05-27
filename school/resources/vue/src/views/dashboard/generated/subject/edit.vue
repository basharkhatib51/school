<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Edit Subject')"
        >
          <b-row>
            <b-col
              cols="12"
              md="6"
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
              md="6"
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
              md="6"
            >
              <div>
                <label>{{ $t('Semester') }}</label>
                <v-select
                  v-model="data.semester"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="['first','second']"
                />
                <small
                  v-if="errors.semester"
                  class="text-danger"
                >{{ errors.semester[0] }}</small>
              </div>
            </b-col>

          </b-row>
        </b-card>
      </b-col>
      <b-col
        cols="12"
        md="4"
      >
        <b-row>
          <b-col cols="12">
            <b-card>
              <b-row>
                <b-col
                  cols="12"
                >
                  <b-button
                    class="w-100 mb-1"
                    variant="gradient-success"
                    @click="update"
                  >
                    {{ $t('Update') }}
                  </b-button>
                  <b-button
                    class="w-100"
                    variant="gradient-danger"
                    @click="resetData"
                  >
                    {{ $t('Reset Form') }}
                  </b-button>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
      </b-col>

    </b-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        name: '', semester: '', percentage: null,
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    ClassLevels() { return this.$store.getters['classLevel/GetElements'] },

    Element() { return this.$store.getters['subject/GetElement'] },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.$store.dispatch('classLevel/GetElements')

    this.getData()
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
    getData() {
      this.$store.dispatch('subject/GetElement', this.$route.params.subject).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('subject/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
