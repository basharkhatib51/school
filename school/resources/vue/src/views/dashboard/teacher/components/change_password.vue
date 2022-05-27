<template>
  <div>
    <b-modal
      ref="my-modal"
      v-model="isActive"
      :title="$t('Change Password')"
      hide-footer
      no-close-on-backdrop
      @close="close"
      @hide="close"
    >
      <div class="con-exemple-prompt">
        <div>
          <div class="form-label-group">
            <b-form-input
              id="floating-label1"
              v-model="password.password"
              type="password"
              :state="errors.password ? false:null"
              :placeholder="$t('New Password')"
              class="mt-2"
            />
            <small
              v-if="errors.password"
              class="text-danger"
            >{{ errors.password[0] }}</small>
            <label>{{ $t('New Password') }}</label>
          </div>
        </div>
        <div>
          <div class="form-label-group">
            <b-form-input
              id="floating-label1"
              v-model="password.password_confirmation"
              type="password"
              :state="errors.password_confirmation ? false:null"
              class="mt-2"
              :placeholder="$t('Password Confirmation')"
            />
            <small
              v-if="errors.password_confirmation"
              class="text-danger"
            >{{ errors.password_confirmation[0] }}</small>
            <label>{{ $t('Password Confirmation') }}</label>
          </div>
        </div>
        <br>
        <b-button
          v-if="!GeneratedPassword"
          variant="gradient-primary"
          @click="GeneratePassword"
        >
          {{ $t('Generated Password') }}
        </b-button>
        <div v-if="GeneratedPassword">
          <div class="form-label-group">
            <b-form-input
              id="PasswordToCopy"
              v-model="GeneratedPassword"
              type="password"
              class="mt-2"
              :placeholder="$t('Generate Password')"
            />
            <label>{{ $t('Generate Password') }}</label>
          </div>

          <br>
          <b-button
            variant="gradient-warning"
            @click="copy"
          >
            {{ $t('Copy Password') }}
          </b-button>
          <b-checkbox
            v-model="SavePlacePassword"
            vs-value="email"
            class="mr-4 mt-2"
          >
            {{ $t('I have copied this password in a safe place.') }}
          </b-checkbox>
        </div>
        <br>
        <br>
        <div>
          <hr>
        </div>
        <div
          class="d-flex justify-content-end"
          @click="changePassword"
        >
          <b-button variant="gradient-success">
            {{ $t('changePassword') }}
          </b-button>
        </div>
        <br>
      </div>
    </b-modal>
  </div>
</template>

<script>
import Vue from 'vue'

export default {
  name: 'ChangePassword',
  props: {
    value: {
      default: null,
      type: Boolean,
    },
    teacher: {
      default: null,
      type: Number,
    },
  },
  data: () => ({
    password: {
      password_confirmation: '',
      password: '0',
    },
    SavePlacePassword: true,
    GeneratedPassword: '',
    Teacher: null,
    errors: [],
  }),
  computed: {
    isActive: {
      get() {
        return this.value
      },
      set(val) {
        this.$emit('input', val)
      },
    },
  },
  methods: {
    close() {
      this.isActive = false
      this.SavePlacePassword = true
      this.errors = []
      this.password.password = ''
      this.password.password_confirmation = ''
      this.GeneratedPassword = ''
    },
    copy() {
      const PasswordToCopy = document.querySelector('#PasswordToCopy')
      PasswordToCopy.removeAttribute('disabled')
      PasswordToCopy.select()
      this.SavePlacePassword = true
      document.execCommand('copy')
      PasswordToCopy.setAttribute('disabled', 'disabled')
      if (this.SavePlacePassword === true) {
        Vue.prototype.$swal({
          icon: 'success',
          title: ('Success'),
          text: ('your password has been copied'),
          showConfirmButton: false,
          allowOutsideClick: true,
        })
      }
    },
    GeneratePassword() {
      this.GeneratedPassword = `${Math.random().toString(36).slice(-8) + Math.random().toString(36).slice(-8)}_A*`
      this.password.password = this.GeneratedPassword
      this.password.password_confirmation = this.GeneratedPassword
      this.SavePlacePassword = false
    },
    changePassword() {
      this.errors = []
      if (this.SavePlacePassword === false) {
        this.isActive = true
      } else {
        this.$store.dispatch('teacher/ChangePassword', { id: this.teacher, password: this.password }).then(() => {
          this.close()
        }).catch(error => {
          if (error.response.data.errors) this.errors = error.response.data.errors
        })
      }
    },
  },
}
</script>

<style scoped>

</style>
