<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card
          :title="$t('Edit Post')"
        >
          <b-row>
            <b-col
              cols="12"
              md="12"
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
              md="12"
            >
              <div class="form-label-group">
                <quill-editor
                  v-model="data.content"
                  class="mt-2"
                />
                <small
                  v-if="errors.content"
                  class="text-danger"
                >{{ errors.content[0] }}</small>
                <label>{{ $t('Content') }}</label>
              </div>
            </b-col>
            <b-col
              cols="12"
              md="12"
            >
              <div class="form-label-group">
                <b-form-textarea
                  v-model="data.excerpt"
                  rows="4"
                  class="mt-2"
                  :placeholder="$t('excerpt')"
                  :state="errors.excerpt ?false:null"
                />
                <small
                  v-if="errors.serial"
                  class="text-danger"
                >{{ errors.excerpt[0] }}</small>
                <label>{{ $t('excerpt') }}</label>
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
            <b-card :title="$t('Tags')">
              <label>{{ $t('please select') }}...</label>
              <v-select
                v-model="data.tags"
                multiple
                :options="Tags"
                :reduce="Tags => Tags.id"
                label="name"
              />
              <small
                v-if="errors.tags"
                class="text-danger"
              >{{ errors.tags[0] }}</small>
            </b-card>
          </b-col>
          <b-col
            cols="12"
            class="justify-content-center"
          >
            <b-card :title="$t('Image')">
              <b-row>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center"
                >
                  <upload
                    v-model="data.image"
                    @on-file-error="UpdateFileError"
                  />
                </b-col>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center mt-2"
                >
                  <small
                    v-if="errors.image"
                    class="text-danger"
                  >{{ errors.image[0] }}</small>
                </b-col>
                <b-col cols="12">
                  <b-alert
                    v-if="fileErrors.length>0"
                    variant="danger"
                    show
                  >
                    <h4 class="alert-heading">
                      {{ $t('Upload Image Error') }}
                    </h4>
                    <div class="alert-body">
                      <span>
                        <ul
                          v-for="(val,index) in fileErrors"
                          :key="index"
                        >
                          <li>{{ val }}</li>
                        </ul>
                      </span>
                    </div>
                  </b-alert>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
          <b-col
            cols="12"
            class="justify-content-center"
          >
            <b-card :title="$t('Background')">
              <b-row>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center"
                >
                  <upload
                    v-model="data.background"
                    @on-file-error="UpdateFileError"
                  />
                </b-col>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center mt-2"
                >
                  <small
                    v-if="errors.background"
                    class="text-danger"
                  >{{ errors.background[0] }}</small>
                </b-col>
                <b-col cols="12">
                  <b-alert
                    v-if="fileErrors.length>0"
                    variant="danger"
                    show
                  >
                    <h4 class="alert-heading">
                      {{ $t('Upload Image Error') }}
                    </h4>
                    <div class="alert-body">
                      <span>
                        <ul
                          v-for="(val,index) in fileErrors"
                          :key="index"
                        >
                          <li>{{ val }}</li>
                        </ul>
                      </span>
                    </div>
                  </b-alert>
                </b-col>
              </b-row>
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
        title: '',
        image: null,
        background: null,
        content: '',
        excerpt: '',
      },
      errors: [],
      fileErrors: '',

    }
  },
  computed: {

    Tags() { return this.$store.getters['tag/GetElements'] },

    Sliders() { return this.$store.getters['slider/GetElements'] },

    Element() { return this.$store.getters['post/GetElement'] },
  },
  watch: {
    // eslint-disable-next-line func-names
    'data.content': function ($new) { if ($new && $new.includes('data:image/')) { this.quill_upload_axios($new).then(response => { this.data.content = response }) } },
  },
  created() {
    this.$store.dispatch('tag/GetElements')

    this.$store.dispatch('slider/GetElements')

    this.getData()
  },
  methods: {
    resetData() {
      this.data = {
        title: '',
        image: null,
        background: null,
        content: '',
        excerpt: '',
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
      this.$store.dispatch('post/GetElement', this.$route.params.post).then(() => {
        this.data = this.Element
      })
    },
    update() {
      this.errors = []
      this.$store.dispatch('post/Update', this.data).then(() => {
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
