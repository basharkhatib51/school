<template>
  <div>
    <b-container>
      <home-post />
    </b-container>
    <home-content>
      <template v-slot:content>
        <features />
      </template>
    </home-content>
    <b-container class="container">
      <home-teacher />
    </b-container>
    <home-content>
      <template v-slot:content>
        <services />
      </template>
    </home-content>
    <b-container fluid>
      <home-contact-us />
    </b-container>
  </div>
</template>

<script>

import HomeContent from '@/layouts/components/home/HomeContent.vue'
import HomeContactUs from '@/views/home/component/HomeContactUs.vue'
import Features from '@/views/home/component/features.vue'
import Services from '@/views/home/component/Services.vue'
import HomePost from '@/views/home/component/HomePost.vue'
import HomeTeacher from '@/views/home/component/HomeTeacher.vue'

export default {
  components: {
    HomeTeacher,
    HomePost,
    Services,
    Features,
    HomeContactUs,
    HomeContent,
  },

}
</script>
