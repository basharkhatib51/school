<template>
  <div id="ui">
    <div
      v-for="el in 40"
      :key="el"
      class="text-login"
    >
      {{ $t('School') }}
    </div>
  </div>
</template>
<script>

export default {
  name: 'AuthImageTemplate',
}
</script>
<style lang="scss">

@import '~@core/scss/vue/pages/page-auth.scss';
@import "~@/assets/scss/3d-text.scss";
</style>
