<template>
  <b-container>
    <b-row>
      <b-col
        v-for="card in cards"
        :key="card.id"
        cols="12"
        md="6"
        lg="4"
      >
        <b-card-group
          class="child-cursor-pointer"
          deck
        >
          <b-card
            :bg-variant="card.color"
            text-variant="white"
            class="text-center"
            @click="open(card.route)"
          >
            <b-card-text>
              <font-awesome-icon
                size="5x"
                :icon="['fas', card.icon]"
              />
              <h3 class="mt-1 text-white">
                {{ card.header }}
              </h3>
            </b-card-text>
          </b-card>
        </b-card-group>
      </b-col>
    </b-row>
  </b-container>
</template>
<script>
export default ({
  data() {
    return {
    }
  },
  computed: {
    cards() {
      return [
        {
          id: 0,
          header: this.$t('Profile'),
          color: 'warning',
          icon: 'user',
          route: 'profile',
        },
        {
          id: 1,
          header: this.$t('Results'),
          color: 'primary',
          icon: 'tasks',
          route: 'scp.results',
        }, {
          id: 2,
          header: this.$t('Chat'),
          color: 'success',
          icon: 'comments',
          route: 'scp.chat',
        }, {
          id: 3,
          header: this.$t('Program'),
          color: 'danger',
          icon: 'calendar-check',
          route: 'scp.program',
        }, {
          id: 4,
          header: this.$t('Subjects'),
          color: 'info',
          icon: 'clipboard-list',
          route: 'scp.subjects',
        }, {
          id: 5,
          header: this.$t('last years'),
          color: 'secondary',
          icon: 'graduation-cap',
          route: 'scp.last_years',
        },
      ]
    },
  },
  methods: {
    open(val) {
      this.$router.push({ name: val })
    },
  },
})
</script>
