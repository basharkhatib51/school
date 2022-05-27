<template>
  <b-nav-item-dropdown
    id="dropdown-grouped"
    no-caret
    variant="link"
    class="dropdown-language"
    right
  >
    <template #button-content>
      <b-img
        :src="currentLocale.img"
        height="14px"
        width="22px"
        :alt="currentLocale.locale"
      />
      <span class="ml-50 text-body">{{ currentLocale.name }}</span>
    </template>
    <b-dropdown-item
      v-for="localeObj in locales"
      :key="localeObj.locale"
      @click="changeLocale(localeObj.locale)"
    >
      <b-img
        :src="localeObj.img"
        height="14px"
        width="22px"
        :alt="localeObj.locale"
      />
      <span class="ml-50">{{ localeObj.name }}</span>
    </b-dropdown-item>
  </b-nav-item-dropdown>
</template>

<script>
import { BNavItemDropdown, BDropdownItem, BImg } from 'bootstrap-vue'
import { $themeConfig } from '@themeConfig'

export default {
  components: {
    BNavItemDropdown,
    BDropdownItem,
    BImg,
  },
  // ! Need to move this computed property to comp function once we get to Vue 3
  computed: {
    currentLocale() {
      return this.locales.find(l => l.locale === this.$i18n.locale)
    },
  },
  methods: {
    changeLocale(val) {
      this.$i18n.locale = val
      localStorage.setItem('locale', val)
      if (val === 'ar') {
        this.$store.commit('appConfig/TOGGLE_RTL', true)
      } else {
        this.$store.commit('appConfig/TOGGLE_RTL', false)
      }
    },
  },
  setup() {
    const { isRTL } = $themeConfig.layout
    /* eslint-disable global-require */
    const locales = [
      // {
      //   locale: 'en',
      //   img: require('@/assets/images/flags/en.png'),
      //   name: 'English',
      // },
      {
        locale: 'ar',
        img: require('@/assets/images/flags/ar.jpg'),
        name: 'Arabic',
      },
      // {
      //   locale: 'tr',
      //   img: require('@/assets/images/flags/tr.jpg'),
      //   name: 'Turkish',
      // },
    ]
    /* eslint-disable global-require */

    return {
      locales,
      isRTL,
    }
  },
}
</script>

<style>

</style>
