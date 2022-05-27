<template>
  <b-container>
    <b-row>
      <b-col
        cols="12"
      >
        <b-card>
          <b-row
            class="justify-content-md-center mb-2"
          >
            <b-col
              cols="12"
              md="4"
              class="p-5"
            >
              <b-img
                class="page-img"
                :src="`${$fullPath}/${page.image_data.url}`"
              />
            </b-col>
            <b-col
              cols="12"
              md="8"
            >
              <b-row>
                <b-col cols="6">
                  <h1
                    class="text-primary text-right"
                  >
                    {{ page.title }}
                  </h1>
                </b-col>
                <b-col
                  cols="12"
                  class="mb-2"
                >
                  <hr>
                  <span
                    class=""
                    v-html="page.content"
                  />
                </b-col>
              </b-row>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  components: {},
  computed: {
    page() {
      return this.$store.getters['home/page']
    },
  },
  created() {
    this.$store.dispatch('home/getPage', this.$route.params.page)
  },
}
</script>

<style lang="scss">

</style>
