<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Create New Menu')"
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
              <div>
                <label>{{ $t('Type') }}</label>
                <v-select
                  v-model="data.type"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="['url','page','post','route']"
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
              <div class="form-label-group">
                <b-form-textarea
                  v-model="data.url"
                  rows="4"
                  class="mt-2"
                  :placeholder="$t('Url')"
                  :state="errors.url ?false:null"
                />
                <small
                  v-if="errors.url"
                  class="text-danger"
                >{{ errors.url[0] }}</small>
                <label>{{ $t('Url') }}</label>
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
            <b-card :title="$t('Posts')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.post"
                :options="Posts"
                :reduce="Posts => Posts.id"
                label="name"
              />
              <small
                v-if="errors.post"
                class="text-danger"
              >{{ errors.post[0] }}</small>
            </b-card>
          </b-col>
          <b-col
            cols="12"
          >
            <b-card :title="$t('Pages')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.page"
                :options="Pages"
                :reduce="Pages => Pages.id"
                label="name"
              />
              <small
                v-if="errors.page"
                class="text-danger"
              >{{ errors.page[0] }}</small>
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
        title: '', type: '', url: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {
    Posts() { return this.$store.getters['post/GetElements'] },

    Pages() { return this.$store.getters['page/GetElements'] },

    Projects() { return this.$store.getters['project/GetElements'] },
  },
  watch: {
    // eslint-disable-next-line func-names

  },
  created() {
    this.$store.dispatch('post/GetElements')

    this.$store.dispatch('page/GetElements')

    this.$store.dispatch('project/GetElements')
  },
  methods: {
    resetData() {
      this.data = {
        title: '', type: '', url: '',
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
      this.$store.dispatch('menu/Create', this.data).then(() => {
        this.data = {
          title: '', type: '', url: '',
        }
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
