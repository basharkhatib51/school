<template>
  <div>
    <b-row>
      <b-col cols="12">
        <b-form-file
          v-model="file"
          accept="application/pdf"
          placeholder="Choose a file or drop it here..."
          drop-placeholder="Drop file here..."
        />
      </b-col>
      <b-col
        cols="12"
        class="mt-1"
      >
        <b-button
          class="w-100"
          variant="outline-success"
          @click="uploadFile"
        >
          {{ $t('Upload') }}
        </b-button>
      </b-col>
    </b-row>
  </div>
</template>

<script>

export default {
  name: 'ChatFileUpload',
  props: {
    value: {
      default: null,
      type: Number,
    },
  },
  data() {
    return {
      file: null,
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
  methods: {
    uploadFile() {
      this.errors = []
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
