<template>
  <b-container>
    <b-row
      class="mt-5"
    >
      <b-col
        cols="12"
        md="3"
        lg="2"
      >
        <b-list-group>
          <b-list-group-item
            href="#"
            class="d-flex justify-content-between align-items-center"
            :active="!subject_registration"
            @click="changeChatRoom(null)"
          >{{ $t('notifications') }}
          </b-list-group-item>
          <b-list-group-item
            v-for="(Subject,key) in Subjects"
            :key="key"
            href="#"
            class="d-flex justify-content-between align-items-center"
            :active="Subject.id===subject_registration"
            @click="changeChatRoom(Subject)"
          >
            <span>{{ Subject.subject_name }}</span>
          </b-list-group-item>
        </b-list-group>
      </b-col>
      <b-col
        cols="12"
        md="9"
        lg="10"
      >
        <b-modal
          v-model="upload_status"
          :title="$t('Upload')"
        >
          <b-row>
            <b-col cols="12">
              <chat-upload v-model="file" />
            </b-col>

          </b-row>
          <template #modal-footer>
            <b-col cols="12">
              <b-button
                v-if="file"
                variant="success"
                class="w-100"
                @click="sendFile"
              >
                {{ $t('send') }}
              </b-button>
              <b-badge
                v-else
                class="w-100"
                variant="light-primary"
              >
                {{ $t('Chose image or file') }}
              </b-badge>
            </b-col>

          </template>
        </b-modal>
        <b-card
          class="chat-widget"
          no-body
        >
          <b-card-header>
            <div class="d-flex align-items-center">
              <b-row>
                <b-col
                  cols="12"
                >
                  <b-button
                    variant="danger"
                    @click="$router.push({name:'scp.dashboard'})"
                  >
                    {{ $t('back to dashboard') }}
                    <font-awesome-icon
                      :icon="['fas', 'arrow-right']"
                    />
                  </b-button>
                </b-col>
              </b-row>
            </div>
          </b-card-header>
          <section
            v-if="subject_registration"
            class="chat-app-window"
          >
            <section
              ref="chatsList"
              class="user-chats scroll-area"
            >
              <div
                class="chats"
              >
                <div
                  v-for="message in Messages"
                  :key="message.id"
                  class="chat"
                  :class="{'chat-left': message.sender_id !== auth.id}"
                >
                  <div class="chat-body">
                    <div
                      class="chat-content"
                      :class="{'chat-content-image': message.type==='image'}"
                    >
                      <b-overlay
                        :show="message.status==='sending'"
                        class="d-inline-block"
                        :opacity="0"
                        blur="5px"
                      >
                        <b-row v-if="message.type==='text'">
                          <b-col
                            v-if="message.sender_name&&message.sender_id !== auth.id"
                            cols="12"
                          >
                            <p class="text-left small">
                              {{ message.sender_name }}
                            </p>
                          </b-col>
                          <b-col
                            cols="12"
                          >
                            <p>
                              {{ message.content }}
                            </p>
                          </b-col>
                          <b-col cols="12">
                            <p class="text-right small">
                              {{ message.created_from }}
                            </p></b-col>
                        </b-row>
                        <div
                          v-if="message.type==='image'"
                          class="chat-image-col"
                        >
                          <p
                            v-if="message.sender_name&&message.sender_id !== auth.id"
                            class="text-left small image-sender-name"
                          >
                            {{ message.sender_name }}
                          </p>
                          <b-img
                            class="chat_image"
                            :src="`${$fullPath}/${message.content.url}`"
                          />
                          <p class="text-right small image-time">
                            {{ message.created_from }}
                          </p>
                        </div>
                        <b-row v-if="message.type==='file'">
                          <b-col
                            v-if="message.sender_name&&message.sender_id !== auth.id"
                            cols="12"
                          >
                            <p class="text-left small">
                              {{ message.sender_name }}
                            </p>
                          </b-col>
                          <b-col
                            cols="12"
                          >
                            <a
                              :href="`${$fullPath}/${message.content.url}`"
                              download
                              class="text-light"
                            >
                              <font-awesome-icon
                                class="m-auto text-primary"
                                :icon="['fas', 'file-pdf']"
                                size="3x"
                              />
                              {{ message.content.original_name }}
                            </a>
                          </b-col>
                          <b-col cols="12">
                            <p class="text-right small">
                              {{ message.created_from }}
                            </p>
                          </b-col>
                        </b-row>
                      </b-overlay>
                    </div>
                  </div>
                </div>

                <section
                  ref="endChatDiv"
                />
              </div>
            </section>
            <b-avatar
              v-if="viewScrollToEnd"
              class="scroll-to-end"
              variant="light-primary"
              button
              @click="scrollEnd"
            >
              <font-awesome-icon
                :icon="['fas','angle-down']"
                size="3x"
              />
            </b-avatar>
            <div
              v-if="subject_registration_status"
              class="chat-app-form"
            >
              <b-button
                variant="primary"
                :disabled="chatInputMessage.length===0"
                @click="sendMessage"
              >
                <font-awesome-icon
                  :icon="['fas', 'paper-plane']"
                />
              </b-button>
              <b-input-group class="input-group-merge form-send-message mx-1">
                <b-form-input
                  v-model="chatInputMessage"
                  :placeholder="$t('Enter your message')"
                  @keyup.enter="sendMessage"
                />
              </b-input-group>
              <b-button
                variant="primary"
                @click="changeUploadStatus"
              >
                <font-awesome-icon
                  :icon="['fas', 'cloud-upload-alt']"
                />
              </b-button>
            </div>
            <div
              v-else
            >
              <b-alert
                variant="danger"
                class="disabled-chat-alert"
                show
              >
                <div class="alert-body text-center">
                  <span>{{ $t('Teacher has been disable chat for this subject') }}</span>
                </div>
              </b-alert>
            </div>
          </section>
          <section
            v-else
            class="mx-1"
          >
            <b-alert
              v-for="(notification,index) in Notifications"
              :key="index"
              variant="primary"
              show
            >
              <h4 class="alert-heading">
                {{ notification.title }}
              </h4>
              <div class="alert-body">
                <span>{{ notification.content }}</span>
              </div>
            </b-alert>
          </section>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>

import ChatUpload from '@/layouts/components/chat/ChatUpload.vue'

export default {
  components: {
    ChatUpload,
  },
  data() {
    return {
      subject_registration: null,
      subject_registration_status: null,
      file: null,
      upload_status: false,
      chatInputMessage: '',
      channel: null,
    }
  },
  computed: {
    Messages() {
      return this.$store.getters['scp/Messages']
    },
    Notifications() {
      return this.$store.getters['scp/Notifications']
    },
    Subjects() {
      return this.$store.getters['scp/Subjects']
    },
    viewScrollToEnd() {
      return true
    },
    auth() {
      return this.$store.getters['auth/GetAuth']
    },
  },
  watch: {
    upload_status() {
      this.file = null
    },
  },
  mounted() {
    this.$store.commit('scp/SET_MESSAGES_DATA', [])
  },
  created() {
    this.$store.dispatch('scp/GetStudentSubjects', this.subject_registration)
    this.getNotifications()
  },
  methods: {
    changeChatRoom(Subject) {
      if (Subject === null) {
        this.subject_registration = null
        if (this.channel) {
          this.channel.unsubscribe('my-channel')
          this.channel.disconnect()
        }
        this.getNotifications()
      } else {
        this.subject_registration = Subject.id
        this.subject_registration_status = Subject.chat_status
        if (this.channel) {
          this.channel.unsubscribe('my-channel')
          this.channel.disconnect()
        }
        this.channel = this.$pusher.subscribe('my-channel')
        this.channel.bind(`subject_id_${Subject.id}`, response => {
          this.pushMsg(response)
          this.scrollEnd()
        })
        this.getMassages()
      }
    },
    getMassages() {
      this.$store.dispatch('scp/GetMessages', this.subject_registration).then(() => {
        this.scrollEnd()
      })
    },
    getNotifications() {
      this.$store.dispatch('scp/GetNotifications').then(() => {
        if (this.Notifications.length > 0) {
          if (localStorage.getItem('lastNotification')) {
            if (localStorage.getItem('lastNotification') !== this.Notifications[0].id.toString()) {
              if (!('Notification' in window)) {
                console.warn('This browser does not support desktop notification')
              } else if (Notification.permission === 'granted') {
                const { title } = this.Notifications[0]
                const { content } = this.Notifications[0]
                // eslint-disable-next-line no-new
                new Notification(title, { content })
              } else {
                Notification.requestPermission()
              }
            }
          }
          localStorage.setItem('lastNotification', this.Notifications[0].id)
        }
      })
    },
    pushMsg(val) {
      this.$store.dispatch('scp/pushMsg', val)
    },
    scrollEnd() {
      this.$smoothScroll({
        scrollTo: this.$refs.endChatDiv,
        updateHistory: false,
        duration: 100,
        container: this.$refs.chatsList,
      })
    },
    sendFile() {
      this.$store.dispatch('scp/SendFileMessage', { subject_registration: this.subject_registration, file: this.file }).then(() => {
        this.scrollEnd()
        this.file = null
        this.upload_status = false
      })
    },
    changeUploadStatus() {
      if (this.upload_status === true) this.upload_status = false
      else this.upload_status = true
    },
    sendMessage() {
      this.$store.dispatch('scp/SendMessage', { subject_registration: this.subject_registration, message: this.chatInputMessage }).then(() => {
        this.scrollEnd()
      })
      this.chatInputMessage = ''
    },
  },
}
</script>
