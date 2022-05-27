<template>
  <div
    class="HomeContactUsComponent"
  >
    <b-row class="justify-content-center text-center ContactBackground">
      <b-col
        cols="12"
        class="text-center"
      >
        <h2 class="ContactHeader">
          {{ $t('Contact Now') }}
        </h2>
      </b-col>
      <b-col
        cols="8"
        md="8"
        lg="4"
        class="mb-2 mb-0"
        align-self="center"
      >
        <!-- name-->
        <div class="form-label-group">
          <b-form-input
            v-model="data.name"
            class="mt-2"
            :placeholder="$t('Name')"
          />
          <label>{{ $t('Name') }}</label>
          <small
            v-if="errors.name"
            class="text-danger"
          >
            {{ errors.name[0] }}
          </small>
        </div>
        <!-- phone-->
        <div class="form-label-group">
          <b-form-input
            v-model="data.phone"
            class="mt-2"
            type="number"
            :placeholder="$t('Phone')"
          />
          <label>{{ $t('Phone') }}</label>
          <small
            v-if="errors.phone"
            class="text-danger"
          >
            {{ errors.phone[0] }}
          </small>
        </div>
        <!-- email -->
        <div class="form-label-group">
          <b-form-input
            v-model="data.email"
            class="mt-2"
            type="email"
            :placeholder="$t('Email')"
          />
          <label>{{ $t('Email') }}</label>
          <small
            v-if="errors.email"
            class="text-danger"
          >
            {{ errors.email[0] }}
          </small>
        </div>
        <!--text-->
        <div class="form-label-group">
          <b-form-textarea
            v-model="data.message"
            class="mt-3"
            type="text"
            :placeholder="$t('your message')"
          />
          <label>{{ $t('your message') }}</label>
          <small
            v-if="errors.message"
            class="text-danger"
          >
            {{ errors.message[0] }}
          </small>
        </div>
        <b-button
          variant="gradient-info"
          class="mt-2"
          @click="Send"
        >
          {{ $t('Send Message') }}
        </b-button>
      </b-col>
      <b-col
        cols="12"
        md="8"
        lg="4"
        align-self="center"
      >
        <b-row>
          <b-col
            cols="12"
            class="mb-3 mt-3 mt-md-0"
          >
            <b-row>
              <b-col
                cols="12"
                class="mb-2"
              >
                <a>
                  <font-awesome-icon
                    class="text-info"
                    :icon="['fas', 'map-marker-alt']"
                  />
                  <span class="ml-1 text-info">
                    {{ $t('Turkey Istanbul') }}
                  </span>
                </a>
              </b-col>
              <b-col
                cols="12"
                class="mb-2"
              >
                <a>
                  <font-awesome-icon
                    class="text-info"
                    :icon="['fas', 'phone-alt']"
                  />
                  <span class="ml-1 text-info">
                    00905313333666
                  </span>
                </a>
              </b-col>
              <b-col
                cols="12"
                class="mb-2"
              >
                <a>
                  <font-awesome-icon
                    class="text-info"
                    :icon="['fas', 'envelope']"
                  />
                  <span class="ml-1 text-info">
                    School@gmail.com
                  </span>
                </a>
              </b-col>
            </b-row>
          </b-col>
          <b-col cols="12">
            <b-row>
              <b-col
                cols="12"
                class="mb-2"
              >
                <h1 class="text-info mb-2">
                  {{ $t('social media') }}
                </h1>
                <a
                  href="https://www.school.layouteam.com/landing-page"
                  class="mr-1 text-info"
                >
                  <font-awesome-icon
                    size="3x"
                    :icon="['fab', 'facebook-square']"
                  />
                </a>
                <a
                  href="https://www.school.layouteam.com/landing-page"
                  class="mr-1 text-info"
                >
                  <font-awesome-icon
                    size="3x"
                    :icon="['fab', 'instagram-square']"
                  />
                </a>
                <a
                  href="https://www.school.layouteam.com/landing-page"
                  class="text-info"
                >
                  <font-awesome-icon
                    size="3x"
                    :icon="['fab', 'whatsapp-square']"
                  />
                </a>
              </b-col>
            </b-row>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
  </div>
</template>
<script>
import Vue from 'vue'

export default {
  data() {
    return {
      errors: [],
      data: {
        name: '',
        email: '',
        phone: '',
        message: '',
      },
    }
  },
  methods: {
    Send() {
      Vue.prototype.$http.post('home/contact_us', this.data).then(() => {
        this.data = {
          name: '',
          email: '',
          phone: '',
          message: '',
        }
        this.errors = []
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
