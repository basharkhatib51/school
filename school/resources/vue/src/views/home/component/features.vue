<template>
  <b-row class="d-flex justify-content-between featuresComponent">
    <b-col
      cols="12"
      class="text-center mb-5 text-light"
    >
      <h2 class="text-white">
        {{ $t('Our best features') }}
      </h2>
      <p class="text-primary">
        {{ $t('Our School provide features that will make you happy') }}
      </p>
    </b-col>
    <b-col
      lg="5"
      cols="12"
      class="mt-5"
    >
      <b-row>
        <b-col
          v-for="el in content"
          :key="el.title"
          cols="12"
          xl="4"
          md="6"
        >
          <b-card-group deck>
            <b-card
              bg-variant="light-info"
              header-text-variant="primary"
              :header="el.title"
              class="text-center"
              text-variant="primary"
              border-variant="primary"
            >
              <font-awesome-icon
                color="primary"
                class="mt-1 text-primary"
                :icon="[el.pack, el.icon]"
                size="3x"
              />
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </b-col>
    <b-col
      lg="5"
      cols="12"
      class="mt-5"
      align-self="center"
    >
      <b-img
        style="width: 100%"
        :src="require('@/assets/images/HomeImage/HOMEIMAGE2.png')"
      />
    </b-col>
  </b-row>
</template>
<script>
export default {
  data() {
    return {
      content: [
        { title: this.$t('Respect appointments'), pack: 'fas', icon: 'clock' },
        { title: this.$t('Competitive prices and discounts'), pack: 'fas', icon: 'file-invoice-dollar' },
        { title: this.$t('Modern methods of education'), pack: 'fas', icon: 'book' },
        { title: this.$t('chat system for students'), pack: 'fas', icon: 'comments' },
        { title: this.$t('Staff of the best teachers'), pack: 'fas', icon: 'users' },
        { title: this.$t('system for the guardian'), pack: 'fas', icon: 'network-wired' },
      ],
    }
  },
}
</script>
<style>
.featuresComponent .card .card-header {
    display: unset;
}
</style>
