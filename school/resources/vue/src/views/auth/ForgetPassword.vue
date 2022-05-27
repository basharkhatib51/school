<template>
  <div class="app">

    <div class="auth-wrapper auth-v2">
      <b-row class="auth-inner m-0">

        <!-- Brand logo-->
        <b-link
          class="brand-logo"
          @click="$router.push({name:'home'})"
        >
          <h2 class="brand-text text-primary ml-1">
            {{ appName }}
          </h2>
        </b-link>
        <!-- /Brand logo-->

        <!-- Left Text-->
        <b-col
          lg="8"
          class="d-none d-lg-flex align-items-center p-5 overflow-hidden"
        >
          <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
            <auth-image-template />
          </div>
        </b-col>
        <!-- /Left Text-->

        <!-- register -->
        <b-col
          lg="4"
          class="d-flex align-items-center auth-bg px-2 p-lg-5"
        >
          <b-col
            sm="8"
            md="6"
            lg="12"
            class="px-xl-2 mx-auto"
          >
            <b-card-title
              title-tag="h2"
              class="font-weight-bold mb-1"
            >
              {{ $t('Welcome to') }} {{ appName }}! 👋
            </b-card-title>
            <b-card-text class="mb-2">
              {{ $t('Enter your email and a link will be sent to your email') }}
            </b-card-text>
            <b-form
              class="auth-login-form mt-2"
              @submit.prevent
            >
              <!-- email -->
              <div class="form-label-group">
                <b-form-input
                  v-model="data.email"
                  class="mt-2"
                  type="email"
                  :placeholder="$t('Email')"
                  :state="errors.email ?false:null"
                />
              </div>
              <b-button
                type="submit"
                variant="primary"
                block
                @click="ResetPassword"
              >
                {{ $t('Send Link') }}
              </b-button>
            </b-form>
          </b-col>
        </b-col>
        <!-- /Login-->
      </b-row>
    </div>

  </div>
</template>

<script>
/* eslint-disable global-require */
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import AuthImageTemplate from '@/views/auth/components/auth_image_template.vue'

export default {
  components: { AuthImageTemplate },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      errors: [],
      data: {
        email: '',
        email_confirmation: '',
      },
      ValidationErrors: '',
    }
  },
  computed: {
    ValidationEmail() {
      if (this.ValidationErrors.email) return this.ValidationErrors.email[0]
      return null
    },
    appName() {
      // return $themeConfig.app.appName
      return this.$store.getters['app/appName']
    },
  },
  beforeCreate() {
    this.$http.get('/sanctum/csrf-cookie')
  },
  methods: {
    ResetPassword() {
      this.$store.dispatch('auth/ForgetPassword', this.data).then(() => {
        this.$router.push({ name: 'login' })
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
