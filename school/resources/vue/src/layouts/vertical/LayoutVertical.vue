<template>
  <layout-vertical>

    <router-view />

    <template #navbar="{ toggleVerticalMenuActive }">
      <navbar :toggle-vertical-menu-active="toggleVerticalMenuActive" />
    </template>
    <div
      slot="vertical-menu-header"
      class="d-flex align-items-center h-100"
    >
      <b-img
        :src="require('@/assets/images/logo/logo.png')"
        class="dashboard-menu-logo"
      />
    </div>
    <app-customizer
      v-if="showCustomizer"
      slot="customizer"
    />
  </layout-vertical>
</template>

<script>
import LayoutVertical from '@core/layouts/layout-vertical/LayoutVertical.vue'
import AppCustomizer from '@core/layouts/components/app-customizer/AppCustomizer.vue'
import { $themeConfig } from '@themeConfig'
import Navbar from '@/layouts/components/Navbar.vue'

export default {
  components: {
    AppCustomizer,
    LayoutVertical,
    Navbar,
  },
  data() {
    return {
      showCustomizer: $themeConfig.layout.customizer,
    }
  },
  created() {
    document.getElementsByTagName('html')[0].classList.remove('home')
  },
}
</script>
