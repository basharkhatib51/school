<template>
  <div>
    <b-row>
      <b-col
        cols="12"
        md="8"
      >
        <b-card :title="$t('Edit Admin')">
          <b-row>
            <b-col
              cols="12"
              md="6"
            >
              <div class="form-label-group">
                <b-form-input
                  v-model="adminData.first_name"
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
                  v-model="adminData.last_name"
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
                  v-model="adminData.email"
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
                  v-model="adminData.phone"
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
            <b-col
              cols="12"
              class="d-flex justify-content-end"
            >

              <b-button
                variant="gradient-success"
                @click="Edit"
              >
                {{ $t('Confirm') }}
              </b-button>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
      <b-col
        cols="12"
        md="4"
      >
        <b-card
          :title="$t('Edit Admin Avatar')"
        >
          <b-row>
            <b-col
              cols="12"
            >
              <upload v-model="adminData.avatar_id" />
            </b-col>

          </b-row>
        </b-card>
      </b-col>

    </b-row>

  </div>
</template>

<script>
import Upload from '@/layouts/components/Upload.vue'

export default {
  components: {
    Upload,
  },
  data() {
    return {
      admin: '',
      adminData: {
        avatar_id: null,
      },
      errors: [],
    }
  },
  computed: {
    Admin() {
      return this.$store.getters['admin/GetAdmin']
    },
  },
  created() {
    this.getData()
  },
  methods: {
    getData() {
      this.admin = this.$route.params.admin
      this.$store.dispatch('admin/GetAdmin', this.admin).then(() => {
        this.adminData = this.Admin
      })
    },
    Edit() {
      this.$store.dispatch('admin/Update', this.adminData).then(() => {
        this.errors = []
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
