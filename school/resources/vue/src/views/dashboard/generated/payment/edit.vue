<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Edit Payment')"
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
            <b-card :title="$t('StudentRegistrations')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.student_registration"
                :options="StudentRegistrations"
                :reduce="StudentRegistrations => StudentRegistrations.id"
                label="name"
              />
              <small
                v-if="errors.student_registration"
                class="text-danger"
              >{{ errors.student_registration[0] }}</small>
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
        value: 0,
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    StudentRegistrations() { return this.$store.getters['studentRegistration/GetElements'] },

    Element() { return this.$store.getters['payment/GetElement'] },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.$store.dispatch('studentRegistration/GetElements')

    this.getData()
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
    getData() {
      this.$store.dispatch('payment/GetElement', this.$route.params.payment).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('payment/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
