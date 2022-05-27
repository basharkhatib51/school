<template>
  <div>
    <b-container>
      <b-row class="mb-2">
        <b-col
          cols="12"
          class="d-flex justify-content-end"
        >
          <b-button
            variant="danger"
            @click="$router.push({name:'scp.dashboard'})"
          >
            <font-awesome-icon
              :icon="['fas', 'arrow-left']"
            />
          </b-button>
        </b-col>
      </b-row>
      <b-row>
        <b-col
          v-for="(val,index) in Subjects"
          :key="index"
          cols="12"
        >
          <b-card :title="val.subject_name">
            <b-row>
              <b-col
                cols="12"
                md="3"
                class="mt-2"
              >
                <b-badge variant="light-success">
                  {{ val.class_level_name }}
                </b-badge>
              </b-col>
              <b-col
                cols="12"
                md="3"
                class="mt-2"
              >
                <b-badge variant="light-success">
                  {{ val.classroom_name }}
                </b-badge>
              </b-col>
              <b-col
                cols="12"
                md="3"
                class="mt-2"
              >
                <b-badge variant="light-success">
                  {{ $t(val.semester_name) }}
                </b-badge>
              </b-col>
              <b-col
                cols="12"
                md="3"
                class="mt-2"
              >
                <b-badge variant="light-success">
                  {{ val.teacher_name }}
                </b-badge>
              </b-col>
              <b-col
                class="d-flex justify-content-end mt-2"
                cols="12"
              >
                <b-button
                  :variant="ExamSection===false?'outline-success':'outline-danger'"
                  @click="ExamSection=!ExamSection"
                >
                  <span v-if="ExamSection===false">
                    {{ $t('See Exams') }}
                  </span>
                  <span v-else>
                    {{ $t('close') }}
                  </span>
                </b-button>
              </b-col>
            </b-row>
            <transition name="fade">
              <b-row v-if="ExamSection">
                <b-col
                  v-for="(v,i) in val.exams"
                  :key="i"
                  class="mt-2"
                  cols="12"
                  md="4"
                >
                  <b-card
                    :title="v.exam_name"
                    bg-variant="light-success"
                  >
                    <b-row>
                      <b-col cols="12">
                        {{ $t('Date:') }} {{ v.date }}
                      </b-col>
                      <b-col cols="12">
                        {{ $t('percentage') }}: {{ v.percentage }}
                      </b-col>
                    </b-row>
                  </b-card>
                </b-col>
              </b-row>
            </transition>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: 'Subjects',
  data() {
    return {
      ExamSection: false,
    }
  },
  computed: {
    Subjects() {
      return this.$store.getters['scp/Subjects']
    },
  },
  created() {
    this.$store.dispatch('scp/GetStudentSubjects')
  },
}
</script>
