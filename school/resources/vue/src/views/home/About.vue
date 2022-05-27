<template>
  <div class="AboutComponent">
    <b-row>
      <b-col>
        <b-row>
          <b-col
            align-self="center"
            cols="12"
            md="12"
            class="text-center "
          >
            <h1 class="head mt-sm-3">
              {{ $t('About School') }}
            </h1>
          </b-col>
          <b-col
            align-self="center"
            cols="12"
            md="12"
            class="text-left mt-1"
          >
            <h4 class="about-content container">
              {{
                $t('It is with pride that I welcome you to our School, a place where our brightest future leaders and stewards come to receive a premier K-12 education, while being inspired to sharpen their skills, develop thoughtful perspectives, and discover their passions.')
              }}
            </h4>
            <h4 class="about-content container">
              {{
                $t('Our enrollment process is designed to create a welcoming experience where young people can feel that they are part of a vibrant community that sincerely supports them, while pushing them outside of their comfort zone into new territories of possibility. Every experience should welcome both a sense of belonging and the possibility to open oneself up to change and growth, which begins with our very first interaction.')
              }}
            </h4>
            <h4 class="about-content container">
              {{
                $t('We do this by creating an environment that fosters individual talents, combines diversity with compassion, and awakens a student’s curiosity for learning beyond a book, to establishing the critical thinking skills needed to excel in an increasingly evolving existence. The pursuit of education becomes a lifelong goal when students are encouraged to find purpose and passion in the classroom.')
              }}
            </h4>
            <h4 class="about-content container">
              {{
                $t('Educating holistically requires developing a comprehensive scholastic framework. Each tier of our educational system combines learning with interactive experiences, as well as opportunities to participate in broad range of activities and the arts. We cultivate empathy, community and respect, creating a learning environment of psychological safety so that our students can focus on developing their curiosities and excelling at school.')
              }}
            </h4>
            <b-row />
          </b-col>
          <b-col
            align-self="center"
            cols="12"
            md="12"
            class="text-center pt-5 pb-2"
          >
            <b-img
              class="w-50"
              :src="require('@/assets/images/HomeImage/kids.png')"
            />
          </b-col>
        </b-row>

      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  components: {
  },
  data() {
    return {
    }
  },
  computed: {
  },
}
</script>
