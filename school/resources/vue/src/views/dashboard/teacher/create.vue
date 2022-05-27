<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        lg="8"
      >
        <b-card
          :title="$t('Create New Teacher')"
        >
          <b-row>
            <b-col
              cols="12"
            >
              <b-row>
                <b-col
                  cols="12"
                  md="6"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="data.model_number"
                      class="mt-2"
                      :placeholder="$t('Teacher Number')"
                      :state="errors.model_number ?false:null"
                    />
                    <small
                      v-if="errors.model_number"
                      class="text-danger"
                    >{{ errors.model_number[0] }}</small>
                    <label>{{ $t('Teacher Number') }}</label>
                  </div>
                </b-col>
                <b-col
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
              </b-row>
            </b-col>
          </b-row>
          <b-row>
            <b-col
              cols="6"
              class="mt-3"
            >
              <b-button
                variant="gradient-danger"
                @click="data={},errors=[]"
              >
                {{ $t('Reset Form') }}
              </b-button>
            </b-col>
            <b-col
              cols="6"
              class="d-flex justify-content-end mt-3"
            >
              <b-button
                variant="gradient-success"
                @click="create_teacher"
              >
                {{ $t('Create') }}
              </b-button>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
      <b-col
        cols="12"
        md="4"
        class="justify-content-center"
      >
        <b-card
          :title="$t('Teacher Avatar')"
        >
          <upload v-model="data.avatar_id" />
        </b-card>
      </b-col>
    </b-row>

  </div>
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
    create_teacher() {
      this.errors = []
      this.$store.dispatch('teacher/Create', this.data).then(() => {
        this.data = {}
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
