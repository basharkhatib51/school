<template>
  <b-row>
    <b-col
      cols="12"
      class="d-flex justify-content-center my-1"
    >
      <div
        :class="!image.id?'UploadImageBorder':''"
        class="d-flex justify-content-center text-center UploadImageButton"
        @click="$refs.refInputEl.click()"
      >
        <input
          ref="refInputEl"
          accept="image/png,image/jpeg"
          type="file"
          name="file"
          class="d-none"
          @change="uploadImage($event)"
        >
        <b-avatar
          v-if="image.id"
          class="m-auto"
          :src="`${path}/${image.url}`"
          size="100px"
        />
        <font-awesome-icon
          v-else
          class="m-auto"
          :icon="['fas', 'upload']"
          size="lg"
        />
      </div>
    </b-col>
    <b-col
      cols="12"
      class="d-flex justify-content-center my-1"
    > <b-button
        v-if="image.id"
        variant="outline-danger"
        @click="image = {} , image.id=null,$refs.refInputEl.value=null"
      >
        <span class="d-none d-sm-inline max-w">{{ $t('Remove') }}</span>
      </b-button>
      <b-button
        v-else
        variant="outline-success"
        @click="$refs.refInputEl.click()"
      >
        {{ $t('Select Image') }}
      </b-button>
    </b-col>
    <b-col cols="12">
      <b-alert
        v-if="errors.length>0"
        variant="danger"
        show
      >
        <h4 class="alert-heading">
          {{ $t('Upload Image Error') }}
        </h4>
        <div class="alert-body">
          <span>
            <ul
              v-for="(val,index) in errors"
              :key="index"
            >
              <li>{{ val }}</li>
            </ul>
          </span>
        </div>
      </b-alert>
    </b-col>
  </b-row>
</template>

<script>

export default {
  name: 'ChatUpload',
  props: {
    value: {
      default: null,
      type: Number,
    },
  },
  data() {
    return {
      image: {},
      errors: [],
    }
  },
  computed: {
    path() {
      return this.$fullPath
    },
    size() {
      return this.$store.getters['upload/size']
    },
  },
  watch: {
    value(val) {
      if (val) {
        this.$store.dispatch('upload/getImage', { id: val }).then(response => {
          this.image = response.data.image
        })
      } else this.image = {}
    },
    image(val) {
      if (val.id) this.$emit('input', val.id)
      else {
        this.$emit('input', null)
      }
    },
  },
  created() {
    if (this.value) {
      this.$store.dispatch('upload/getImage', { id: this.value }).then(response => {
        this.image = response.data.image
      })
    } else {
      this.image = {}
    }
  },
  methods: {
    uploadImage(event) {
      this.errors = []
      if (event.target.files[0]) {
        this.$store.dispatch('upload/uploadImage', event.target.files[0]).then(response => {
          this.image = response.data.image
          this.$emit('on-file-error', [])
        }).catch(error => {
          this.errors = error.response.data.errors.file
          this.$emit('on-file-error', error.response.data.errors.file)
        })
      }
    },
  },

}
</script>
<style>
.UploadImageButton {
    border-radius: 50%;
    width: 100px;
    height: 100px;
}

.UploadImageButton:hover {
    cursor: pointer
}

.UploadImageBorder {
    border: 1px dashed
}
</style>
