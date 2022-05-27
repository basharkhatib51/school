<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Create New Setting')"
        >
          <b-row>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="data.key"
                  class="mt-2"
                  :state="errors.key ?false:null"
                  :placeholder="$t('Key')"
                />
                <small
                  v-if="errors.key"
                  class="text-danger"
                >{{ errors.key[0] }}</small>
                <label>{{ $t('Key') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-textarea
                  v-model="data.value"
                  rows="4"
                  class="mt-2"
                  :placeholder="$t('Value')"
                  :state="errors.value ?false:null"
                />
                <small
                  v-if="errors.value"
                  class="text-danger"
                >{{ errors.value[0] }}</small>
                <label>{{ $t('Value') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-textarea
                  v-model="data.default"
                  rows="4"
                  class="mt-2"
                  :placeholder="$t('Default')"
                  :state="errors.default ?false:null"
                />
                <small
                  v-if="errors.default"
                  class="text-danger"
                >{{ errors.default[0] }}</small>
                <label>{{ $t('Default') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-textarea
                  v-model="data.option"
                  rows="4"
                  class="mt-2"
                  :placeholder="$t('Option')"
                  :state="errors.option ?false:null"
                />
                <small
                  v-if="errors.option"
                  class="text-danger"
                >{{ errors.option[0] }}</small>
                <label>{{ $t('Option') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div>
                <label>{{ $t('Type') }}</label>
                <v-select
                  v-model="data.type"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="['number','text','string','image','boolean','enum']"
                />
                <small
                  v-if="errors.type"
                  class="text-danger"
                >{{ errors.type[0] }}</small>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div>
                <label>{{ $t('Pack') }}</label>
                <v-select
                  v-model="data.pack"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="['fas','fab','far','feather']"
                />
                <small
                  v-if="errors.pack"
                  class="text-danger"
                >{{ errors.pack[0] }}</small>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="data.icon"
                  class="mt-2"
                  :state="errors.icon ?false:null"
                  :placeholder="$t('Icon')"
                />
                <small
                  v-if="errors.icon"
                  class="text-danger"
                >{{ errors.icon[0] }}</small>
                <label>{{ $t('Icon') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="data.tab"
                  class="mt-2"
                  :state="errors.tab ?false:null"
                  :placeholder="$t('Tab')"
                />
                <small
                  v-if="errors.tab"
                  class="text-danger"
                >{{ errors.tab[0] }}</small>
                <label>{{ $t('Tab') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <cleave
                  v-model="data.index"
                  class="form-control mt-2"
                  :raw="false"
                  :options="{
                    numeral: true,
                    numeralThousandsGroupStyle: 'none',
                    numeralDecimalScale: 0,
                  }"
                  placeholder="Index"
                  :state="errors.index ?false:null"
                  :class="errors.index ?'is-invalid':null"
                />
                <small
                  v-if="errors.index"
                  class="text-danger"
                >{{ errors.index[0] }}</small>
                <label>{{ $t('Index') }}</label>
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
                    @click="data={},errors=[]"
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
      data: {},
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    Element() { return this.$store.getters['setting/GetElement'] },
  },
  created() {
    this.getData()
  },
  methods: {
    setBoolean(val) {
      if (this.data[val] === undefined) { this.data[val] = false }
    },
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    getData() {
      this.$store.dispatch('setting/GetElement', this.$route.params.setting).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('setting/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },

  },
}
</script>
