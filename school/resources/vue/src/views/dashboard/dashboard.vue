<template>
  <div>
    <h3>{{ $t('Statistics') }}</h3>
    <b-row class="mt-3">
      <b-col
        v-for="(val,index) in data"
        :key="index"
        cols="12"
        sm="6"
        md="4"
        lg="3"
      >
        <b-card
          :title="$t(index)"
          class="text-center"
        >
          <b-row>
            <b-col cols="12">
              <font-awesome-icon
                class="text-primary"
                size="2x"
                :icon="['fas', val.icon]"
              />
            </b-col>
            <b-col
              cols="12"
              class="mt-1"
            >
              <b-badge variant="primary">
                {{ val.data }}
              </b-badge>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>
<script>
import Vue from 'vue'

export default {
  components: {
  },
  data() {
    return {
      data: {
      },
    }
  },
  computed: {
  },
  created() {
    Vue.prototype.$http.get('analytics').then(response => {
      this.data = response.data.data
    })
  },
}
</script>
