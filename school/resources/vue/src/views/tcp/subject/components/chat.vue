<template>
  <div>
    <b-modal
      v-model="changeChatStatus"
      :title="$t('Change Chat Status')"
      no-close-on-backdrop
      hide-footer
    >
      <b-row>
        <b-col cols="12">
          {{ $t('Are you sure you want to change chat status') }}
        </b-col>
        <b-col
          cols="12"
          class="mt-2 d-flex justify-content-end"
        >
          <b-button
            class="mr-1"
            variant="success"
            @click="ChangeStatus"
          >
            {{ $t('Confirm') }}
          </b-button>
          <b-button
            variant="danger"
            @click="CloseChangeStatus"
          >
            {{ $t('Cancel') }}
          </b-button>
        </b-col>
      </b-row>
    </b-modal>
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
          <b-avatar
            size="34"
            :src="auth.avatar?`${$fullPath}/${auth.avatar}`:null"
            class="mr-50 badge-minimal"
            badge
            badge-variant="success"
          />
          <h5 class="mb-0">
            {{ auth.name }}
          </h5>
        </div>
        <a
          v-if="SubjectRegistration.chat_status===0"
          v-b-tooltip.hover.v-danger
          :title="$t('Deactivate')"
          class="text-success"
          @click="ChangeChatStatus"
        >
          <font-awesome-icon
            :icon="['fas', 'comment']"
          />
        </a>
        <a
          v-else
          v-b-tooltip.hover.v-success
          :title="$t('Activate')"
          class="text-danger"
          @click="ChangeChatStatus"
        >
          <font-awesome-icon
            :icon="['fas', 'comment-slash']"
          />
        </a>
      </b-card-header>

      <section
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
      </section>
    </b-card>
  </div>
</template>

<script>

import ChatUpload from '@/layouts/components/chat/ChatUpload.vue'

export default {
  name: 'SubjectChat',
  components: {
    ChatUpload,
  },
  data() {
    return {
      file: null,
      upload_status: false,
      changeChatStatus: false,
      chatInputMessage: '',
      chatInputMessages: { message: 'asd' },
    }
  },

  computed: {
    Messages() {
      return this.$store.getters['tcp/Messages']
    },
    viewScrollToEnd() {
      return true
    },
    SubjectRegistration() {
      return this.$store.getters['tcp/SubjectRegistration']
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
    this.$store.commit('tcp/SET_MESSAGES_DATA', [])
  },
  created() {
    const channel = this.$pusher.subscribe('my-channel')
    channel.bind(`subject_id_${this.$route.params.subject_registration}`, response => {
      this.pushMsg(response)
      this.scrollEnd()
    })
    this.$store.dispatch('tcp/GetMessages', this.$route.params.subject_registration).then(() => {
      this.scrollEnd()
    })
  },
  methods: {
    pushMsg(val) {
      this.$store.dispatch('tcp/pushMsg', val)
    },
    scrollEnd() {
      this.$smoothScroll({
        scrollTo: this.$refs.endChatDiv,
        duration: 100,
        container: this.$refs.chatsList,
      })
    },
    sendFile() {
      this.$store.dispatch('tcp/SendFileMessage', { subject_registration: this.$route.params.subject_registration, file: this.file }).then(() => {
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
      this.$store.dispatch('tcp/SendMessage', { subject_registration: this.$route.params.subject_registration, message: this.chatInputMessage }).then(() => {
        this.scrollEnd()
      })
      this.chatInputMessage = ''
    },
    ChangeStatus() {
      this.$store.dispatch('tcp/ChangeChatStatus', this.SubjectRegistration.id).then(() => {
        this.changeChatStatus = false
      })
    },
    CloseChangeStatus() {
      this.changeChatStatus = false
    },
    ChangeChatStatus() {
      this.changeChatStatus = true
    },
  },
}
</script>
