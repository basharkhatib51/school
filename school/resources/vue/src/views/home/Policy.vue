<template>
  <div class="policy-component">
    <div class="container">
      <b-row>
        <b-col>
          <b-card
            class="text-center"
          >
            <b-row>
              <b-col
                align-self="center"
                cols="12"
                class="text-center"
              >

                <h1>
                  {{ $t('policy') }}
                </h1>
                <p class="pt-5 pl-3 text-left">
                  {{ $t('Attendance Policy ') }}:
                  {{
                    $t('Attendance is important. Missing too many classes can create huge gaps that can lead to academic failure')
                  }}
                </p>
                <p class="pl-3 text-left">
                  {{ $t('Cell Phone Policy') }}:
                  {{
                    $t(' It is essential that schools evaluate their cell phone policy and figure out what will work best for their setting.')
                  }}
                </p>
                <p class="pl-3 text-left">
                  {{ $t('Dress Code Policy') }}:
                  {{
                    $t(' School uniform must be adhered to.')
                  }}
                </p>
                <p class="pl-3 text-left">
                  {{ $t('Respect Policy') }}:
                  {{
                    $t(' I am a firm believer that when students respect teachers and teachers respect students that it can only benefit learning.')
                  }}
                </p>
              </b-col>

            </b-row>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data() {
    return {
      policy_content: [this.$t('Exporting all around the world.'), this.$t('Free spare parts during the guarantee period.'), this.$t('Installation and running the production lines in the customer’s location.'), this.$t('Training the customer’s staff to operate and maintenance of the production lines.')],
    }
  },
  computed: {
  },
}
</script>
