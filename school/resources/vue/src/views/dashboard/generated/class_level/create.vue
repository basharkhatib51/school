<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Create New ClassLevel')"
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
        name: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {},
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {},
  methods: {
    resetData() {
      this.data = {
        name: '',
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
      this.$store.dispatch('classLevel/Create', this.data).then(() => {
        this.data = {
          name: '',
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
