<template>
  <layout-full>
    <router-view />
  </layout-full>
</template>

<script>
import LayoutFull from '@core/layouts/layout-full/LayoutFull.vue'

export default {
  components: {
    LayoutFull,
  },
  created() {
    document.getElementsByTagName('html')[0].classList.remove('home')
    document.getElementsByTagName('html')[0].classList.add('home')
  },
}
</script>
