<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab
        :title="$t('Teacher Data')"
        active
      >
        <b-row>
          <b-col
            cols="12"
            lg="8"
            class="justify-content-center"
          >
            <b-card
              :title="$t('Edit Teacher')"
              bg-variant="light-primary"
              border-variant="primary"
            >
              <b-row>
                <b-col
                  cols="12"
                  md="12"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="teacherData.model_number"
                      class="mt-2"
                      :state="errors.model_number ? false:null"
                      :placeholder="$t('Teacher number')"
                      type="number"
                    />
                    <small
                      v-if="errors.model_number"
                      class="text-danger"
                    >{{ errors.model_number[0] }}</small>
                    <label>{{ $t('Teacher number') }}</label>
                  </div>
                </b-col>

                <b-col
                  cols="12"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="teacherData.email"
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
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="teacherData.phone"
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
                  md="6"
                >
                  <div class="form-label-group">
                    <b-form-input
                      v-model="teacherData.first_name"
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
                      v-model="teacherData.last_name"
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
                >
                  <b-button
                    variant="gradient-success"
                    class="w-100"
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
            lg="4"
          >

            <b-card
              :title="$t('Teacher Avatar')"
              bg-variant="light-primary"
              border-variant="primary"
            >
              <b-row>
                <b-col
                  cols="12"
                  class="d-flex justify-content-center"
                >
                  <upload v-model="teacherData.avatar_id" />
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
      </b-tab>
      <b-tab :title="$t('Subjects')">
        <b-row>
          <b-col
            cols="12"
            lg="8"
          >
            <subject-registration-list />
          </b-col>
          <b-col
            cols="12"
            lg="4"
          >
            <b-row>
              <b-col
                cols="12"
              >
                <subject-registration-create />
              </b-col>
            </b-row>
          </b-col>
        </b-row>
      </b-tab>
      <b-tab :title="$t('Teacher Program')">
        <b-row v-if="Teacher.programs">
          <b-col
            v-for="(val,index) in Teacher.programs"
            :key="index"
            cols="12"
          >
            <b-card :title="$t(index)">
              <b-table
                v-if="val.length>0"
                :fields="fields"
                responsive="sm"
                :items="val"
                class="table-w-max"
              >
                <template #cell(subject_name)="data">
                  <b-badge variant="light-info">
                    {{ data.item.subject_name }}
                  </b-badge>
                </template>
                <template #cell(class_level_name)="data">
                  <b-badge variant="light-info">
                    {{ data.item.class_level_name }}
                  </b-badge>
                </template>
                <template #cell(classroom_name)="data">
                  {{ data.item.classroom_name }}
                </template>
                <template #cell(start_at)="data">
                  <b-badge variant="light-success">
                    {{ data.item.start_at }}
                  </b-badge>
                </template>
                <template #cell(finish_at)="data">
                  <b-badge variant="light-danger">
                    {{ data.item.finish_at }}
                  </b-badge>
                </template>
                <template #cell(options)="data">
                  <a @click="Delete(data.item.id)">
                    <font-awesome-icon
                      class="text-danger"
                      :icon="['fas', 'trash']"
                    />
                  </a>
                </template>
              </b-table>
            </b-card>
          </b-col>
        </b-row>
        <b-row v-else>
          <b-col>
            <b-card :title="$t('teacher program')">
              <b-alert
                variant="danger"
                show
              >
                <div class="alert-body text-center">
                  <span>
                    {{ $t('teacher taken subject doesn\'t have program yet') }}
                  </span>
                </div>
              </b-alert>
            </b-card>
          </b-col></b-row>
      </b-tab>
    </b-tabs>
  </div>
</template>

<script>
import Upload from '@/layouts/components/Upload.vue'
import SubjectRegistrationCreate from '@/views/dashboard/teacher/components/subject_registration_create.vue'
import SubjectRegistrationList from '@/views/dashboard/teacher/components/subject_registration_list.vue'

export default {
  components: {
    Upload,
    SubjectRegistrationCreate,
    SubjectRegistrationList,
  },
  data() {
    return {
      perPage: 5,
      currentPage: 1,
      filter: null,
      teacherData: {
        phone: null,
        email: null,
        last_name: null,
        first_name: null,
        model_number: null,
        avatar_id: null,
      },
      errors: [],
    }
  },
  computed: {
    Teacher() {
      return this.$store.getters['teacher/GetTeacher']
    },
    fields() {
      return [
        { key: 'subject_name', label: this.$t('subject') },
        { key: 'classroom_name', label: this.$t('classroom') },
        { key: 'class_level_name', label: this.$t('class_level') },
        { key: 'start_at', label: this.$t('start_at') },
        { key: 'finish_at', label: this.$t('finish_at') },
        { key: 'options', label: this.$t('options') },
      ]
    },
  },
  created() {
    this.getData()
  },
  methods: {
    getData() {
      this.$store.dispatch('teacher/GetTeacher', this.$route.params.teacher).then(() => {
        this.teacherData = this.Teacher
      })
    },
    Edit() {
      this.$store.dispatch('teacher/Update', this.teacherData).then(() => {
        this.errors = []
      }).catch(error => {
        this.errors = error.response.data.errors
      })
    },
  },
}
</script>
