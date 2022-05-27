<template>
  <b-row class="d-flex justify-content-between">
    <b-col
      cols="12"
      class="text-center mb-5 text-white"
    >
      <h2 class="mb-2 text-white">
        {{ $t('Our best services') }}
      </h2>
      <p class="services">
        {{ $t('School provide features that will make you happy') }}
      </p>
    </b-col>
    <b-col
      cols="12"
      lg="5"
    >
      <b-img
        style="width: 100%"
        :src="require('@/assets/images/HomeImage/schoolHome.png')"
      />
    </b-col>
    <b-col
      cols="12"
      lg="5"
      class="mt-5"
      align-self="center"
    ><span class="text-primary">
      {{ $t(' Teaching from the first to the twelfth grade with the best teachers and the latest teaching methods We have a complete system available for parents to track the child and correspond with teachers, and a system for students to follow lessons and communicate with each other and with the teacher Attention to the request from an ethical, health and technical point of view') }}
    </span>
    </b-col>
  </b-row>
</template>
