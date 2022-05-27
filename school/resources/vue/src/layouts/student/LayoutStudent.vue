<template>
  <div>
    <home-header />
    <layout-full>
      <router-view />
    </layout-full>
  </div>
</template>

<script>
import LayoutFull from '@core/layouts/layout-full/LayoutFull.vue'
import HomeHeader from '@/layouts/components/home/HomeHeader.vue'

export default {
  components: {
    HomeHeader,
    LayoutFull,
  },
  created() {
    document.getElementsByTagName('html')[0].classList.remove('home')
    document.getElementsByTagName('html')[0].classList.add('home')
    document.getElementsByTagName('body')[0].classList.remove('dark-layout')
    // document.getElementsByTagName('body')[0].classList.add('dark-layout')
  },
}
</script>
