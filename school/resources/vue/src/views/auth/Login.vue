<template>
  <div class="app login-page">
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

        <!-- Login-->
        <b-col
          lg="4"
          class="d-flex align-items-center auth-bg px-2 p-lg-5"
        >
          <b-col
            sm="8"
            md="6"
            lg="12"
            class="px-xl-2 mx-auto text-light"
          >
            <b-card-title
              title-tag="h2"
              class="font-weight-bold mb-1 text-light"
            >
              {{ $t('Welcome to Our school') }} ! 👋
            </b-card-title>
            <b-card-text class="mb-2">
              {{ $t('Please sign-in to your account and start learning') }}
            </b-card-text>
            <b-form
              class="auth-login-form mt-2"
              @submit.prevent
            >
              <div>
                <b-tabs

                  v-model="login_type"
                  class="text-light"
                  content-class="mt-3 text-light"
                  justified
                >
                  <b-tab
                    :title="$t('Student')"
                    class="text-light"
                    active
                  >
                    <div class="form-label-group">
                      <b-form-input
                        v-model="user_name"
                        class="mt-2"
                        :placeholder="$t('Student Number')"
                        :state="ValidationErrors.user_name ?false:null"
                      />
                      <small
                        v-if="ValidationErrors.user_name"
                        class="text-danger"
                      >
                        {{ ValidationErrors.user_name[0] }}
                      </small>
                      <label>{{ $t('Student Number') }}</label>
                    </div>
                  </b-tab>
                  <b-tab
                    :title="$t('Teacher')"
                  >
                    <div class="form-label-group">
                      <b-form-input
                        v-model="user_name"
                        class="mt-2"
                        :placeholder="$t('Teacher Number')"
                        :state="ValidationErrors.user_name ?false:null"
                      />
                      <small
                        v-if="ValidationErrors.user_name"
                        class="text-danger"
                      >
                        {{ ValidationErrors.user_name[0] }}
                      </small>
                      <label>{{ $t('Teacher Number') }}</label>
                    </div>
                  </b-tab>
                  <b-tab
                    class="text-light"
                    :title="$t('Family')"
                  >
                    <div class="form-label-group">
                      <b-form-input
                        v-model="user_name"
                        class="mt-2"
                        :placeholder="$t('Student Number')"
                        :state="ValidationErrors.user_name ?false:null"
                      />
                      <small
                        v-if="ValidationErrors.user_name"
                        class="text-danger"
                      >
                        {{ ValidationErrors.user_name[0] }}
                      </small>
                      <label>{{ $t('Student Number') }}</label>
                    </div>
                  </b-tab>
                  <b-tab
                    class="text-light"
                    :title="$t('Admin')"
                  >
                    <div class="form-label-group">
                      <b-form-input
                        v-model="user_name"
                        class="mt-2"
                        :placeholder="$t('Email')"
                        :state="ValidationErrors.user_name ?false:null"
                      />
                      <small
                        v-if="ValidationErrors.user_name"
                        class="text-danger"
                      >
                        {{ ValidationErrors.user_name[0] }}
                      </small>
                      <label>{{ $t('Email') }}</label>
                    </div>
                  </b-tab>
                </b-tabs>
              </div>
              <div class="form-label-group">
                <b-form-input
                  v-model="password"
                  class="mt-2"
                  type="password"
                  :placeholder="$t('Password')"
                  :state="ValidationErrors.user_name?false:null"
                />
                <small
                  v-if="ValidationErrors.user_name"
                  class="text-danger"
                >
                  {{ $t('You have entered an invalid user_name or password') }}
                </small>
                <label>{{ $t('Password') }}</label>
              </div>
              <!-- submit buttons -->
              <b-button
                type="submit"
                variant="primary"
                block
                @click="Login"
              >
                {{ $t('Sign in') }}
              </b-button>

              <b-row>
                <b-col
                  cols="12"
                  class="mt-2 d-flex justify-content-center"
                >
                  <span>{{ $t('OR') }}</span>
                </b-col>
                <b-col
                  cols="12"
                  class="mt-2"
                >
                  <b-button
                    type="submit"
                    variant="success"
                    block
                    @click="$router.push({name:'home'})"
                  >
                    {{ $t('back to the website') }}
                  </b-button>
                </b-col>
              </b-row>
            </b-form>
          </b-col>
        </b-col>
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
      login_type: 0,
      status: false,
      password: 'password',
      user_name: '123456789',
      ValidationErrors: '',
    }
  },
  computed: {
    appName() {
      // return $themeConfig.app.appName
      return this.$store.getters['app/appName']
    },
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
  },
  watch: {
    login_type(val) {
      if (val === 0) { this.user_name = '123456789' } else if (val === 1) { this.user_name = '123456' } else if (val === 2) { this.user_name = '123456789' } else if (val === 3) { this.user_name = 'admin@admin.com' }
    },
  },
  beforeCreate() {
    this.$http.get('/sanctum/csrf-cookie')
  },
  methods: {
    Login() {
      this.ValidationErrors = ''
      this.$store.dispatch('auth/Login', {
        login_type: this.login_type,
        user_name: this.user_name,
        password: this.password,
        remember_me: this.status,
      }).then(response => {
        if (response.data.user.user_type === 'student') {
          this.$router.push({
            name: 'scp.dashboard',
          })
        } else if (response.data.user.user_type === 'teacher') {
          this.$router.push({
            name: 'tcp.dashboard',
          })
        } else if (response.data.user.user_type === 'family') {
          this.$router.push({
            name: 'fcp.dashboard',
          })
        } else if (response.data.user.user_type === 'admin') {
          this.$router.push({
            name: 'dashboard',
          })
        } else {
          this.$router.push({
            name: 'home',
          })
        }
      }).catch(error => {
        this.ValidationErrors = error.response.data.errors
      })
    },
    social_login(provider) {
      this.$store.dispatch('auth/SocialLoginAction', provider).then(response => {
        if (response.data.url) {
          window.location.href = response.data.url
        }
      })
    },

  },
}
</script>
<style>
.login-page .text-light > div > ul li a{
    color : #fff;
}

</style>
