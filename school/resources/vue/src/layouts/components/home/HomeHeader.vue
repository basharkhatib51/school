<template>
  <div>
    <nav-bar />
    <slider v-if="slider && slider!=='null'" />
    <div
      v-else-if="slider!=='null'"
      class="min-slider"
    />
    <div
      v-else
      class="min-slider hidden-slider"
    />
  </div>
</template>

<script>
import NavBar from '@/layouts/components/home/NavBar.vue'
import Slider from '@/layouts/components/home/Slider.vue'

export default {
  components: { Slider, NavBar },
  computed: {
    slider() {
      return this.$route.meta.slider
    },
  },
}
</script>
