<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Create New Subject')"
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
          <b-col
            cols="12"
          >
            <b-card :title="$t('ClassLevels')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.class_level"
                :options="ClassLevels"
                :reduce="ClassLevels => ClassLevels.id"
                label="name"
              />
              <small
                v-if="errors.class_level"
                class="text-danger"
              >{{ errors.class_level[0] }}</small>
            </b-card>
          </b-col>

          <b-col cols="12">
            <b-card>
              <b-row>
                <b-col
                  cols="12"
                >
                  <b-button
                    class="w-100 mb-1"
                    variant="gradient-success"
                    @click="create"
                  >
                    {{ $t('Create') }}
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
        name: '', semester: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    ClassLevels() { return this.$store.getters['classLevel/GetElements'] },
  },
  created() {
    this.$store.dispatch('classLevel/GetElements')
  },
  methods: {
    resetData() {
      this.data = {
        name: '', semester: '',
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
      this.$store.dispatch('subject/Create', this.data).then(() => {
        this.data = {
          name: '', semester: '',
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
