<template>
  <b-card :title="$t('Setting')">
    <b-tabs justified>
      <b-tab
        v-for="(val,index) in data"
        :key="index"
      >
        <template #title>
          <span>{{ index }}</span>
        </template>
        <b-card-body>
          <b-row>
            <b-col
              v-for="(item,i) in val"
              :key="i"
              :cols="item.col"
              class="mt-2"
            >
              <div
                v-if="item.type==='string'"
                class="form-label-group"
              >
                <b-form-input
                  v-model="item.value"
                  :placeholder="item.key"
                />
              </div>
              <div
                v-if="item.type==='enum'"
                class="form-label-group"
              >
                <v-select
                  v-model="item.value"
                  :options="item.options"
                />
              </div>
              <div
                v-if="item.type==='text'"
                class="form-label-group"
              >
                <label>{{ item.key }}</label>
                <b-form-textarea
                  id="textarea-default"
                  v-model="item.value"
                  placeholder="Textarea"
                  rows="3"
                />
              </div>

              <div
                v-if="item.type==='image'"
                class="form-label-group"
              >
                <upload v-model="item.value" />
              </div>
              <div
                v-if="item.type==='boolean'"
                class="form-label-group"
              >
                <div class="demo-inline-spacing">
                  <b-form-checkbox
                    v-model="item.value"
                    :value="true"
                  >
                    {{ item.key }}
                  </b-form-checkbox>
                </div>
              </div>
            </b-col>
          </b-row>
        </b-card-body>
      </b-tab>
    </b-tabs>
    <b-row>
      <b-col
        cols="12"
        class="d-flex justify-content-end"
      >
        <b-button
          variant="success"
          @click="updateSettings"
        >
          {{ $t('Save') }}
        </b-button>
      </b-col>
    </b-row>
  </b-card>
</template>
<script>
export default {
  components: {
  },
  data() {
    return {
      data: {},
    }
  },
  created() {
    this.getSettings()
  },
  methods: {
    getSettings() {
      this.$http.get('settings/groups').then(response => {
        this.data = response.data.data
      })
    },
    updateSettings() {
      this.$http.put('settings/update', this.data).then(() => {
        this.getSettings()
      })
    },
  },
}
</script>
