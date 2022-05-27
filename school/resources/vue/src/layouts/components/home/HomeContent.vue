<template>
  <div>

    <div class="waves rotate-180" />
    <div class="slider">
      <div class="container">
        <slot name="content" />
      </div>
    </div>

    <div class="waves" />
  </div>

</template>
<script>
export default {
}
</script>
<style scoped>

.slider {
    min-height: 300px;
    padding: 100px 50px;
    background: #082465;
    text-align: center;
}

</style>
