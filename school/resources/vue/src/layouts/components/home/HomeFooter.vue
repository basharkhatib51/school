<template>
  <section
    data-aos="zoom-in"
    class="footer-section"
  >
    <b-container
      class="footer-container mt-5 text-white"
    >
      <b-row class="text-center my-5 footer-list">
        <b-col
          cols="12"
          md="4"
          align-self="center"
          class="p-5 table-middle align-middle vlr"
        >
          <img
            :src="require('@/assets/images/logo/logo.png')"
            width="90%"
          >
        </b-col>
        <b-col
          cols="12"
          md="4"
          class="p-5"
        >
          <h1 class="text-white">
            {{ $t('Our Team Support your') }}
          </h1>
          <h5 class="text-primary mt-2">
            {{ $t('contact us to get more information') }}
          </h5>
          <br>
          <br>
          <b-button
            variant="primary"
            class="w-100 text-white"
          >
            <font-awesome-icon :icon="['fas','phone']" />
            +963454864156
          </b-button>
          <br>
          <br>
          <b-button
            variant="primary"
            class="w-100 text-white"
          >
            {{ $t('Contact Us') }}
          </b-button>
        </b-col>
        <b-col
          class="map-col"
          cols="12"
          md="4"
        >
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d892.2405172122667!2d32.666286414791315!3d41.21899386058766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x408355cb5913620f%3A0x8590f8b637fc2d0a!2sTrend%20D%C3%B6ner!5e0!3m2!1sen!2str!4v1628024617941!5m2!1sen!2str"
            class="footer-map"
            allowfullscreen=""
            loading="lazy"
          />
        </b-col>
      </b-row>
    </b-container>
    <b-container fluid>
      <b-row
        class="text-center footer py-1 text-white"
      >
        <b-col
          cols="12"
        >
          {{ $t('Copyright') }} © 2021
          <span class="text-primary">
            School
          </span>
          , {{ $t('All rights Reserved') }}
          <br>
          {{ $t('Developed by') }} <a
            href="https://layouteam.com"
            class="text-primary"
          >layouteam</a>
        </b-col>
      </b-row>
    </b-container>

  </section>
</template>
<style scoped>
.footer-list {
    border-radius: 25px;
    background: #082465;
}

.footer-container {

}

.footer {
    background: #082465;
}

.footer-map {
    border-radius: 0 25px 25px 0;
    border: 0;
    width: 100%;
    height: 100%;
}.map-col{
     padding-right: 0;
     padding-left: 0;
 }
.vlr {
    border-right: 3px solid  #ffc107;
}
@media (max-width: 800px) {
    .footer-map {
        border-radius: 0 0 25px 25px;
        border: 0;
        width: 100%;
        height: 100%;
    }
    .vlr {
        border-right:0;
    }
}

</style>
