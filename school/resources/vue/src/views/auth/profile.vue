<template>
  <b-container>
    <b-row>
      <b-col>

        <change-password-auth
          v-model="changePassword"
          :user="user"
        />
        <b-card>
          <b-row>
            <b-col
              cols="6"
              class="d-flex justify-content-start"
            >
              <h3 class="text-primary">
                {{ $t('Edit Profile') }}
              </h3>
            </b-col>
            <b-col
              cols="6"
              class="d-flex justify-content-end"
            >
              <b-button
                variant="outline-primary"
                @click="ChangePassword()"
              >
                {{ $t('Change Password') }}
              </b-button>
            </b-col>
            <b-col
              cols="12"
              md="4"
              class="d-flex justify-content-center mt-5"
            >
              <upload
                v-model="userData.avatar_id"
              />
            </b-col>
            <b-col
              cols="12"
              md="8"
            >
              <b-row>
                <b-col
                  cols="12"
                  md="6"
                >
                  <div class="form-label-group">
                    <b-form-input

                      v-model="userData.first_name"
                      :disabled="userData.user_type==='student'"
                      class="mt-2"
                      :state="errors.first_name ? false:null"
                      :placeholder="$t('First Name')"
                    />
                    <small
                      v-if="errors.first_name"
                      class="text-danger"
                    >{{ errors.first_name[0] }}</small>
                    <label>{{ $t('First Name') }}</label>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                  md="6"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="userData.last_name"
                      :disabled="userData.user_type==='student'"
                      :state="errors.last_name ? false:null"
                      class="mt-2"
                      :placeholder="$t('Last Name')"
                    />
                    <small
                      v-if="errors.last_name"
                      class="text-danger"
                    >{{ errors.last_name[0] }}</small>
                    <label>{{ $t('Last Name') }}</label>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                  md="6"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="userData.email"
                      class="mt-2"
                      :state="errors.email ? false:null"
                      :placeholder="$t('Email')"
                    />
                    <small
                      v-if="errors.email"
                      class="text-danger"
                    >{{ errors.email[0] }}</small>
                    <label>{{ $t('Email') }}</label>
                  </div>
                </b-col>
                <b-col
                  cols="12"
                  md="6"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="userData.phone"
                      class="mt-2"
                      :state="errors.phone ? false:null"
                      :placeholder="$t('Phone')"
                      type="number"
                    />
                    <small
                      v-if="errors.phone"
                      class="text-danger"
                    >{{ errors.phone[0] }}</small>
                    <label>{{ $t('Phone') }}</label>
                  </div>
                </b-col>
              </b-row>
            </b-col>
          </b-row>
          <b-row>
            <b-col
              cols="12"
              class="d-flex justify-content-end mt-3"
            >
              <b-button
                variant="gradient-success"
                @click="Update"
              >
                {{ $t('Confirm') }}
              </b-button>
            </b-col>
          </b-row>

        </b-card>

      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Upload from '@/layouts/components/Upload.vue'
import ChangePasswordAuth from '@/views/auth/components/change_password_auth.vue'

export default {
  components: {
    ChangePasswordAuth,
    Upload,
  },
  data() {
    return {
      user: null,
      userData: {
        avatar_id: null,
      },
      errors: [],
      changePassword: false,
      language: '',
      language_op: [
        'English', 'Arabic', 'Turkish',
      ],
    }
  },
  computed: {
    User() {
      return this.$store.getters['auth/GetAuth']
    },
  },
  watch: {
    User(val) {
      this.userData = { ...val }
    },
  },
  created() {
    this.userData = { ...this.$store.getters['auth/GetAuth'] }
  },
  methods: {
    ChangePassword() {
      this.user = this.userData.id
      this.changePassword = true
    },
    Update() {
      this.$store.dispatch('auth/UpdateProfile', this.userData).then(() => {
        this.errors = []
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
