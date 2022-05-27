<template>
  <b-row>
    <b-col
      cols="12"
      md="8"
    >
      <b-card
        :title="$t('Create New Student')"
      >
        <b-row>
          <b-col
            cols="12"
            class="mt-2"
          >
            <span>{{ $t('Student') }}</span>
            <hr>
          </b-col>
          <b-col
            cols="12"
            md="6"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.model_number"
                class="mt-2"
                :placeholder="$t('Student Number')"
                :state="errors.model_number ?false:null"
              />
              <small
                v-if="errors.model_number"
                class="text-danger"
              >{{ errors.model_number[0] }}</small>
              <label>{{ $t('Student Number') }}</label>
            </div>
          </b-col>
          <b-col
            cols="12"
            md="6"
          >
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
              <label>{{ $t('Last Name') }}</label>
            </div>
          </b-col>
          <b-col
            cols="12"
            md="6"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.phone"
                class="mt-2"
                :placeholder="$t('Phone')"
                :state="errors.phone ?false:null"
                type="number"
              />
              <small
                v-if="errors.phone"
                class="text-danger"
              >
                {{ errors.phone[0] }}
              </small>
              <label>{{ $t('Phone') }}</label>
            </div>
          </b-col>
          <b-col
            v-if="false"
            cols="12"
            md="6"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.email"
                class="mt-2"
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
          </b-col>
          <b-col
            cols="12"
            class="mt-2"
          >
            <span>{{ $t('Family') }}</span>
            <hr>
          </b-col>
          <b-col
            cols="12"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.family_first_name"
                class="mt-2"
                :placeholder="$t('Family Name')"
                :state="errors.family_first_name ?false:null"
              />
              <small
                v-if="errors.family_first_name"
                class="text-danger"
              >{{ errors.family_first_name[0] }}</small>
              <label>{{ $t('Family Name') }}</label>
            </div>
          </b-col>
          <b-col
            v-if="false"
            cols="12"
            md="6"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.family_last_name"
                class="mt-2"
                :placeholder="$t('Family Last Name')"
                :state="errors.family_last_name ?false:null"
              />
              <small
                v-if="errors.family_last_name"
                class="text-danger"
              >
                {{ errors.family_last_name[0] }}
              </small>
              <label>{{ $t('Family Last Name') }}</label>
            </div>
          </b-col>
          <b-col
            cols="12"
            md="6"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.family_phone"
                class="mt-2"
                :placeholder="$t('Family Phone')"
                :state="errors.family_phone ?false:null"
                type="number"
              />
              <small
                v-if="errors.family_phone"
                class="text-danger"
              >
                {{ errors.family_phone[0] }}
              </small>
              <label>{{ $t('Family Phone') }}</label>
            </div>
          </b-col>
          <b-col
            cols="12"
            md="6"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.family_email"
                class="mt-2"
                :placeholder="$t('Family Email')"
                :state="errors.family_email ?false:null"
              />
              <small
                v-if="errors.family_email"
                class="text-danger"
              >
                {{ errors.family_email[0] }}
              </small>
              <label>{{ $t('Family Email') }}</label>
            </div>
          </b-col>
          <b-col
            cols="12"
            class="mt-2"
          >
            <span>{{ $t('Password') }}</span>
            <hr>
          </b-col>

          <b-col
            cols="12"
            md="6"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.password"
                class="mt-2"
                :placeholder="$t('Password')"
                :state="errors.password ?false:null"
                type="password"
                autocomplete="new-password"
              />
              <small
                v-if="errors.password"
                class="text-danger"
              >
                {{ errors.password[0] }}
              </small>
              <label>{{ $t('Password') }}</label>
            </div>
          </b-col>
          <b-col
            cols="12"
            md="6"
          >
            <div class="form-label-group">
              <b-form-input
                v-model="data.family_password"
                class="mt-2"
                :placeholder="$t('Family  Password')"
                :state="errors.family_password ?false:null"
                type="password"
                autocomplete="new-password"
              />
              <small
                v-if="errors.family_password"
                class="text-danger"
              >
                {{ errors.family_password[0] }}
              </small>
              <label>{{ $t('Family Password') }}</label>
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
          <b-card
            :title="$t('Student Avatar')"
          >
            <upload
              v-model="data.avatar_id"
              @on-file-error="UpdateFileError"
            />
          </b-card>
        </b-col>
        <b-col
          cols="12"
        >
          <b-card
            :title="$t('Create New Student')"
          >
            <b-button
              variant="gradient-success"
              class="w-100 my-1"
              @click="create_student"
            >
              {{ $t('Create') }}
            </b-button>
            <b-button
              variant="gradient-danger"
              class="w-100 my-1"
              @click="data={},errors=[]"
            >
              {{ $t('Reset Form') }}
            </b-button>
          </b-card>
        </b-col>
      </b-row>
    </b-col>
  </b-row>

</template>

<script>
export default {
  data() {
    return {
      data: {},
      errors: [],
      fileErrors: '',

    }
  },
  computed: {},
  methods: {
    UpdateFileError(variable) {
      this.fileErrors = variable
    },
    create_student() {
      this.errors = []
      this.$store.dispatch('student/Create', this.data).then(() => {
        this.data = {}
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
