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

        <!-- sign up -->
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
              <!--                first name-->
              <div class="form-label-group">
                <b-form-input
                  v-model="data.first_name"
                  class="mt-2"
                  :placeholder="$t('First Name')"
                  :state="errors.first_name ?false:null"
                />
                <small
                  v-if="errors.first_name"
                  class="text-danger"
                >
                  {{ errors.first_name[0] }}
                </small>
                <label>{{ $t('First Name') }}</label>
              </div>
              <!--                last name-->
              <div class="form-label-group">
                <b-form-input
                  v-model="data.last_name"
                  class="mt-2"
                  :placeholder="$t('Last Name')"
                  :state="errors.last_name ?false:null"
                />
                <small
                  v-if="errors.last_name"
                  class="text-danger"
                >
                  {{ errors.last_name[0] }}
                </small>
                <label>{{ $t('First Name') }}</label>
              </div>
              <!--                user name-->
              <!-- email -->
              <div class="form-label-group">
                <b-form-input
                  v-model="data.email"
                  class="mt-2"
                  disabled
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
              <!--                phone-->
              <div class="form-label-group">
                <b-form-input
                  v-model="data.phone"
                  class="mt-2"
                  type="number"
                  :placeholder="$t('Phone')"
                  :state="errors.phone ?false:null"
                />
                <small
                  v-if="errors.phone"
                  class="text-danger"
                >
                  {{ errors.phone[0] }}
                </small>
                <label>{{ $t('Phone') }}</label>
              </div>
              <!--                password-->
              <div class="form-label-group">
                <b-form-input
                  v-model="data.password"
                  class="mt-2"
                  type="password"
                  :placeholder="$t('Password')"
                  :state="errors.password ?false:null"
                />
                <small
                  v-if="errors.password"
                  class="text-danger"
                >
                  {{ errors.password[0] }}
                </small>
                <label>{{ $t('Password') }}</label>
              </div>
              <!--                confirm password-->
              <div class="form-label-group">
                <b-form-input
                  v-model="data.password_confirmation"
                  class="mt-2"
                  type="password"
                  :placeholder="$t('Confirm password')"
                  :state="errors.password_confirmation?false:null"
                />
                <small
                  v-if="errors.password_confirmation"
                  class="text-danger"
                >
                  {{ errors.password_confirmation[0] }}
                </small>
                <label>{{ $t('Confirm password') }}</label>
              </div>
              <!--                language-->
              <label>{{ $t('please select language') }}...</label>
              <v-select
                v-model="data.language"
                :options="language_op"
                class="mb-3"
              />
              <!-- submit buttons -->
              <b-button
                type="submit"
                variant="primary"
                block
                @click="signup"
              >
                {{ $t('Create an account') }}
              </b-button>
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
                <b-button
                  variant="microsoft"
                  href="javascript:void(0)"
                >
                  <font-awesome-icon :icon="['fab', 'microsoft']" />
                </b-button>
                <b-button
                  variant="linkedin"
                  href="javascript:void(0)"
                  @click="social_login('linkedin')"
                >
                  <font-awesome-icon :icon="['fab', 'linkedin']" />
                </b-button>
                <b-button
                  variant="github"
                  href="javascript:void(0)"
                  @click="social_login('github')"
                >
                  <feather-icon icon="GithubIcon" />
                </b-button>
                <b-button
                  variant="warning"
                  href="javascript:void(0)"
                  @click="social_login('gitlab')"
                >
                  <font-awesome-icon :icon="['fab', 'gitlab']" />
                </b-button>
              </div>
            </b-form></b-col>
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
      data: {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        password: ' ',
        password_confirmation: '',
        language: '',
      },
      errors: [],
      ValidationErrors: '',
      language_op: [
        'english', 'arabic', 'turkish',
      ],
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
  created() {
    setTimeout(() => {
      this.data.email = ''
      this.data.password = ''
    }, 1000)
    this.data.link = this.$route.params.link
    this.data.email = this.$route.params.email
    this.$store.dispatch('auth/CheckCode', { email: this.$route.params.email, link: this.$route.params.link, type: 'sign_up' }).then(response => {
      if (response.data.status === false) {
        this.$router.push({ name: 'error-404' })
      }
    })
  },
  methods: {
    signup() {
      this.$store.dispatch('auth/signup', this.data).then(() => {
        this.$router.push({ name: 'login' })
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
