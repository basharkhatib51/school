<template>
  <div class="HomePostComponent">
    <b-row class="d-flex justify-content-center">
      <b-col
        cols="12"
        md="6"
      >
        <b-card
          v-for="(val,index) in posts"
          :key="index"
          :img-src="val.image_data?`${$fullPath}/${val.image_data.url}`:null"
        >
          <b-card-title>
            {{ val.title }}
          </b-card-title>
          <b-row>
            <b-col
              cols="12"
              class="mt-5 mt-lg-0 d-flex justify-content-start"
            >
              <span
                class="postContent w-100"
                v-html="val.content"
              />
            </b-col>
          </b-row>
        </b-card>
      </b-col>
      <b-col
        cols="12"
        class="d-flex justify-content-center"
      >
        <b-button
          variant="primary"
          class="mt-3"
          @click="$router.push({name:'posts'})"
        >
          <font-awesome-icon
            class="text-white m-auto"
            :icon="['fas', 'arrow-down']"
          />
          {{ $t('Read more') }}
        </b-button>
      </b-col>
    </b-row>
  </div>
</template>

<script>

export default {
  components: {
  },
  data() {
    return {}
  },
  computed: {
    posts() {
      return this.$store.getters['home/posts']
    },
  },
  created() {
    this.$store.dispatch('home/getPosts')
  },
}
</script>
