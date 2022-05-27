<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Create New Notification')"
        >
          <b-row>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="data.title"
                  class="mt-2"
                  :state="errors.title ?false:null"
                  :placeholder="$t('Title')"
                />
                <small
                  v-if="errors.title"
                  class="text-danger"
                >{{ errors.title[0] }}</small>
                <label>{{ $t('Title') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-textarea
                  v-model="data.content"
                  rows="4"
                  class="mt-2"
                  :placeholder="$t('Content')"
                  :state="errors.content ?false:null"
                />
                <small
                  v-if="errors.content"
                  class="text-danger"
                >{{ errors.content[0] }}</small>
                <label>{{ $t('Content') }}</label>
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
                v-model="data.class_levels"
                multiple
                :options="ClassLevels"
                :reduce="ClassLevels => ClassLevels.id"
                label="name"
              />
              <small
                v-if="errors.class_levels"
                class="text-danger"
              >{{ errors.class_levels[0] }}</small>
            </b-card>
          </b-col>
          <b-col
            v-if="data.class_levels.length===1"
            cols="12"
          >
            <b-card :title="$t('Classrooms')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.classroom"
                :options="Classrooms"
                :reduce="Classrooms => Classrooms.id"
                label="name"
              />
              <small
                v-if="errors.classroom"
                class="text-danger"
              >{{ errors.classroom[0] }}</small>
            </b-card>
          </b-col>

          <b-col cols="12">
            <b-card>
              <b-row>
                <b-col
                  cols="12"
                >
                  <b-button
                    class="w-100"
                    variant="gradient-success"
                    @click="create"
                  >
                    {{ $t('Create') }}
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
        title: '', content: '', class_levels: [], classroom: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    ClassLevels() { return this.$store.getters['classLevel/GetElements'] },
    Classrooms() {
      return this.$store.getters['classroom/GetElements']
    },
  },
  watch: {
    'data.class_levels': function watch($new) {
      if ($new === null) {
        this.data.class_levels = null
      } else if (this.data.class_levels.length >= 2) {
        this.data.classroom = ''
      } else if (this.data.class_levels.length === 1) {
        this.$store.dispatch('classroom/GetElementsFilter', { class_level: this.data.class_levels[0] })
      }
    },
  },
  created() {
    this.$store.dispatch('classLevel/GetElements')
  },
  methods: {
    setBoolean(val) {
      if (this.data[val] === undefined) { this.data[val] = false }
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    create() {
      this.errors = []
      this.$store.dispatch('notification/Create', this.data).then(() => {
        this.data = {
          title: '', content: '', class_levels: [], classroom: '',
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
