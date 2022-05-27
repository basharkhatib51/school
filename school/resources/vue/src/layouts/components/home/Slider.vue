<template>
  <div class="slider">
    <b-row>
      <b-col
        cols="12"
        md="12"
        lg="6"
        align-self="center"
        data-aos="fade-left"
        class="sliderMedia"
      >
        <h3 class="sliderHeader">
          {{ $t('Welcome to') }}
        </h3>
        <h3 class="sliderHeader">
          {{ $t('Best educations') }}
        </h3>
        <p class="sliderContent my-2">
          {{ $t('We are here to make you enjoy learning') }} <br> {{ $t('We help each student achieve their goal') }}
        </p>
        <b-button variant="gradient-primary">
          {{ $t('contact') }}
        </b-button>
      </b-col>
      <b-col
        cols="12"
        md="12"
        lg="6"
        class="mt-3 mt-md-0"
      >
        <b-img
          class="sliderImage"
          :src="require('@/assets/images/HomeImage/teaching.svg')"
        />
      </b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  data() {
    return {
      slide: 0,
    }
  },
  created() {

  },
}
</script>
<style scoped>

.slider {
    min-height: 900px;
    padding: 100px 50px;
    text-align: center;
    background-image: url("~@/assets/images/HomeImage/hero-bg.png");
    background-repeat: no-repeat;
    background-position: left top;
    background-size: contain;
}

.hover-svg-logo {
    display: block;
    font: 8em 'School';
    animation: logo 4s;
}

@keyframes logo {
    0% { font: 1em 'School';}
    50% { font: 5em 'School';}
    100% { transform: rotateZ(720deg);font: 8em 'School';}
}
.text-copy {
    fill: none;
    stroke: white;
    stroke-dasharray: 6% 29%;
    stroke-width: 5px;
    stroke-dashoffset: 0%;
    animation: stroke-offset 5.5s infinite linear;
}
.text-copy:nth-child(1){
    stroke: #ffc107;
    animation-delay: -1s;
}
.text-copy:nth-child(2){
    stroke: #ffc107;
    animation-delay: -2s;
}
.text-copy:nth-child(3){
    stroke: #ffc107;
    animation-delay: -3s;
}
.text-copy:nth-child(4){
    stroke: #ffc107;
    animation-delay: -4s;
}
.text-copy:nth-child(5){
    stroke: #ffc107;
    animation-delay: -5s;
}
@keyframes stroke-offset{
    100% {stroke-dashoffset: -35%;}
}
.sliderHeader{
    font-size: 2rem;
    color: white;
}
.sliderContent{
    color: white;
    ont-size: 2rem;
}
.sliderImage{
    max-width: 85%;
}
@media only screen and (max-width: 600px) {
    .sliderMedia {
        top: -50px;
    }
}
@media only screen and (min-width: 700px) {
    .sliderMedia {
        margin-bottom: 40px;
    }
}
</style>
