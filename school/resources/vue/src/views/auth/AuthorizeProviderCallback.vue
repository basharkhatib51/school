<template>
  <b-container>
    <b-row class="justify-content-md-center">
      <b-col cols="6">
        <b-card
          class="text-center"
        >
          <h1>
            <font-awesome-icon
              :class="`provider-icon ${provider}`"
              :icon="['fab', provider]"
            />
          </h1>
          <h5>{{ provider }} redirecting please waite</h5>
          <div class="loading">
            <div class="effect-1 effects" />
            <div class="effect-2 effects" />
            <div class="effect-3 effects" />
          </div>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      provider: null,
      code: null,
    }
  },
  created() {
    this.provider = this.$route.params.provider
    this.code = this.$route.query.code
    this.social_login(this.provider, this.code)
  },
  methods: {
    social_login(provider, token) {
      this.$store.dispatch('auth/SocialLoginCallback', { provider, token }).then(response => {
        if (response.data.token) {
          this.$router.push({
            name: 'dashboard',
          })
        } else {
          this.$router.push({
            name: 'login',
          })
        }
      }).catch(() => {
        this.$router.push({
          name: 'login',
        })
      })
    },
  },
}
</script>

<style scoped>
.loading {
    position: relative;
}
.card{
    margin-top: 40vh;
}
.provider-icon{
    border-radius: 2px;
    padding: 2px;
    font-size: 50px;
}
.facebook {
    color: #1551b1;
}
.google {
    color: #de5246;
}

</style>
