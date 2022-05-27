<template>
  <div>
    <b-tabs>
      <b-tab :title="$t('students')">
        <subject-student-list />
      </b-tab>
      <b-tab :title="$t('Exams')">
        <subject-create-exam />
      </b-tab>
      <b-tab
        lazy
        :title="$t('chat')"
      >
        <subject-chat />
      </b-tab>
    </b-tabs>
  </div>
</template>

<script>

import SubjectStudentList from '@/views/tcp/subject/components/students_list.vue'
import SubjectCreateExam from '@/views/tcp/subject/components/create_exam.vue'
import SubjectChat from '@/views/tcp/subject/components/chat.vue'

export default {
  components: { SubjectChat, SubjectCreateExam, SubjectStudentList },
  data() {
    return {
    }
  },
  computed: {
  },
  created() {
    this.$store.dispatch('tcp/GetSubjectRegistration', this.$route.params.subject_registration)
  },
  methods: {
  },
}
</script>

<style>

</style>
