<template>
  <div>
    <b-navbar
      id="HomeNavBar"
      :class="IsScroll"
      fixed="top"
      toggleable="lg"
      type="muted"
    >
      <b-navbar-brand href="#">
        <b-img
          class="navbar-logo"
          :src="require('@/assets/images/logo/logo.png')"
        />
      </b-navbar-brand>
      <b-navbar-toggle
        target="nav-collapse"
        class="bars-icon"
      >
        <font-awesome-icon
          class="fas-bars-icon"
          :icon="['fas','bars']"
        />
        <font-awesome-icon
          class="fas-times-icon"
          :icon="['fas','times']"
        />
      </b-navbar-toggle>
      <b-collapse
        id="nav-collapse"
        is-nav
      >
        <b-navbar-nav>
          <div
            v-for="el in elements"
            :key="el.id"
          >
            <b-nav-item
              v-if="el.type!=='url'"
              :to="getUrl(el)"
              class="ml-1"
              :class="isActive(el.url)"
            >
              {{ el.title }}
            </b-nav-item>
            <b-nav-item
              v-if="el.type==='url'"
              :href="getExUrl(el)"
              class="ml-1"
            >
              {{ el.title }}
            </b-nav-item>
          </div>
        </b-navbar-nav>
        <b-navbar-nav
          v-if="isAuth"
          class="nav align-items-center ml-auto"
        >
          <locale />
          <b-nav-item-dropdown
            no-caret
            right
            toggle-class="d-flex align-items-center dropdown-user-link"
            class="dropdown-user ml-2"
          >
            <template #button-content>
              <div class="d-sm-flex d-none user-nav">
                <p
                  v-if="user.user_type==='student'||user.user_type==='teacher'"
                  class="user-name font-weight-bolder mb-0"
                >
                  {{ user.first_name }}-{{ user.last_name }}<br>
                  {{ user.model_number }}
                </p>
                <p
                  v-else-if="user.user_type==='admin'"
                  class="user-name font-weight-bolder mb-0"
                >
                  {{ user.first_name }}-{{ user.last_name }}<br>
                  {{ user.email }}
                </p>
                <p
                  v-else-if="user.user_type==='family'"
                  class="user-name font-weight-bolder mb-0"
                >
                  {{ user.first_name }}-{{ user.last_name }}<br>
                  {{ user.student.first_name }}-{{ user.student.last_name }}
                </p>
              </div>
              <b-avatar
                size="40"
                variant="light-primary"
                badge
                :src="user.avatar?`${$fullPath}/${user.avatar}`:null"
                class="badge-minimal ml-1"
                badge-variant="success"
              />
            </template>
            <b-dropdown-item
              v-if="MixInUserType==='admin'"
              link-class="d-flex align-items-center"
              @click="$router.push({name:'dashboard'})"
            >
              <font-awesome-icon
                pack="fas"
                icon="tachometer-alt"
                class="mr-50"
              />
              <span>
                {{ $t('Dashboard') }}
              </span>
            </b-dropdown-item>
            <b-dropdown-item
              v-if="MixInUserType==='teacher'"
              link-class="d-flex align-items-center"
              @click="$router.push({name:'tcp.dashboard'})"
            >
              <font-awesome-icon
                pack="fas"
                icon="tachometer-alt"
                class="mr-50"
              />
              <span>
                {{ $t('Dashboard') }}
              </span>
            </b-dropdown-item>
            <b-dropdown-item
              v-if="MixInUserType==='student'"
              link-class="d-flex align-items-center"
              @click="$router.push({name:'scp.dashboard'})"
            >
              <font-awesome-icon
                pack="fas"
                icon="tachometer-alt"
                class="mr-50"
              />
              <span>
                {{ $t('Dashboard') }}
              </span>
            </b-dropdown-item>
            <b-dropdown-item
              v-if="MixInUserType==='family'"
              link-class="d-flex align-items-center"
              @click="$router.push({name:'fcp.dashboard'})"
            >
              <font-awesome-icon
                pack="fas"
                icon="tachometer-alt"
                class="mr-50"
              />
              <span>
                {{ $t('Dashboard') }}
              </span>
            </b-dropdown-item>
            <b-dropdown-item
              link-class="d-flex align-items-center"
              @click="$router.push({name:'profile'})"
            >
              <font-awesome-icon
                pack="fas"
                icon="user"
                class="mr-50"
              />
              <span>
                {{ $t('Profile') }}
              </span>
            </b-dropdown-item>
            <b-dropdown-divider />
            <b-dropdown-item
              link-class="d-flex align-items-center"
              @click="logout"
            >
              <feather-icon
                size="16"
                icon="LogOutIcon"
                class="mr-50"
              />
              <span>{{ $t('Logout') }}</span>
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
        <b-navbar-nav
          v-else
          class="nav align-items-center ml-auto"
        >
          <locale />
          <div class="ml-2">
            <router-link
              :to="{name:'login'}"
            >
              {{ $t('Login') }}
            </router-link>
          </div>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>
<script>
import Locale from '@/layouts/components/Locale.vue'

export default {
  components: { Locale },
  data() {
    return {
      IsScroll: null,
      // element: ['home', 'About', 'Contact', 'Policy'],
    }
  },
  computed: {
    isAuth() {
      return this.$store.getters['auth/isAuth']
    },
    user() {
      return this.$store.getters['auth/GetAuth']
    },
    elements() {
      return this.$store.getters['home/menuElements']
    },
  },
  created() {
    this.$store.dispatch('home/getMenuElements')
    window.addEventListener('scroll', this.handleScroll)
  },
  destroyed() {
    window.removeEventListener('scroll', this.handleScroll)
  },
  methods: {
    getExUrl(val) {
      if (['url'].includes(val.type)) return val.url
      return null
    },
    getUrl(val) {
      if (['route'].includes(val.type)) return { name: val.url }
      if (['page'].includes(val.type)) return { name: 'page', params: { page: val.page } }
      if (['post'].includes(val.type)) return { name: 'post', params: { post: val.post } }
      return {}
    },
    logout() {
      this.$store.dispatch('auth/Logout')
    },
    isActive(link) {
      if (this.$route.name === link) return 'active'
      return null
    },
    handleScroll() {
      if (window.scrollY > 10) {
        this.IsScroll = 'navIsScrolled'
      } else this.IsScroll = null
    },
  },
}
</script>
<style scoped>
.navbar-collapse.collapse.show {
    background-color: #182023;
    padding: 20px;
    border-radius: 25px;
}

.navbar-collapse.collapse.show ul li {
    padding: 2px 28px;
}

.navbar {
    background-color: #08246500;
    transition: all 2s;
}

.navIsScrolled {
    background-color: #082465ee;
    box-shadow: 0px 0px 10px 5px #082465ee;
    transition: all 2s;
}

.nav-item.active {
    background-color: #ffc107ee;
    border-radius: 25px;
}

.nav-item.active a {
    color: #182023 !important;
}

.nav-item a:hover {
    background-color: #ffc10755;
    border-radius: 25px;
}
</style>
