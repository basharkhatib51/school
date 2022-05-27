<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Create New Fee')"
        >
          <b-row>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <cleave
                  v-model="data.value"
                  class="form-control mt-2"
                  :raw="false"
                  :options="{
                    numeral: true,
                    numeralThousandsGroupStyle: 'none',
                    numeralDecimalScale: 0,
                  }"
                  :placeholder="$t('Value')"
                  :state="errors.value ?false:null"
                  :class="errors.value ?'is-invalid':null"
                />
                <small
                  v-if="errors.value"
                  class="text-danger"
                >{{ errors.value[0] }}</small>
                <label>{{ $t('Value') }}</label>
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
          <b-col
            cols="12"
          >
            <b-card :title="$t('Years')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.year"
                :options="Years"
                :reduce="Years => Years.id"
                label="name"
              />
              <small
                v-if="errors.year"
                class="text-danger"
              >{{ errors.year[0] }}</small>
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
        value: 0,
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    ClassLevels() { return this.$store.getters['classLevel/GetElements'] },

    Years() { return this.$store.getters['year/GetElements'] },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.$store.dispatch('classLevel/GetElements')

    this.$store.dispatch('year/GetElements')
  },
  methods: {
    resetData() {
      this.data = {
        value: 0,
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
      this.$store.dispatch('fee/Create', this.data).then(() => {
        this.data = {
          value: 0,
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
