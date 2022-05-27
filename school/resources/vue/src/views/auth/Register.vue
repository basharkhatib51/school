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
              {{ $t('Please enter your information correctly to register') }}
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
                <small
                  v-if="errors.email"
                  class="text-danger"
                >
                  {{ errors.email[0] }}
                </small>
                <label>{{ $t('Email') }}</label>
              </div>
              <!-- confirm email -->
              <div class="form-label-group mb-2">
                <b-form-input
                  v-model="data.email_confirmation"
                  class="mt-2"
                  type="email"
                  :placeholder="$t('Confirm Email')"
                  :state="errors.email_confirmation ?false:null"
                />
                <small
                  v-if="errors.email_confirmation"
                  class="text-danger"
                >{{ errors.email_confirmation[0] }}</small>
                <label>{{ $t('Confirm Email') }}</label>
              </div>
              <!-- submit buttons -->
              <b-button
                type="submit"
                variant="primary"
                block
                @click="register"
              >
                {{ $t('Register') }}
              </b-button>
            </b-form>

            <b-card-text class="text-center mt-2">
              <span>{{ $t('If you have an account?') }} </span>
              <b-link :to="{name:'login'}">
                <span>&nbsp;{{ $t('sign in') }}</span>
              </b-link>
            </b-card-text>

            <!-- divider -->
            <div class="divider my-2">
              <div class="divider-text">
                {{ $t('or') }}
              </div>
            </div>

            <!-- social buttons -->
            <div class="auth-footer-btn d-flex justify-content-center">
              <b-button
                variant="facebook"
                href="javascript:void(0)"
                @click="social_login('facebook')"
              >
                <feather-icon icon="FacebookIcon" />
              </b-button>
              <b-button
                variant="google"
                href="javascript:void(0)"
                @click="social_login('google')"
              >
                <font-awesome-icon :icon="['fab', 'google']" />
              </b-button>
            </div>
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
    register() {
      this.$store.dispatch('auth/register', this.data).then(() => {
        this.$router.push({ name: 'login' })
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
    social_login(val) {
      this.$store.dispatch('auth/social_register', val).then(() => {
        this.$router.push({ name: 'login' })
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
