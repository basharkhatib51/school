import Vue from 'vue'

const actions = {
  uploadImageOrFile({ commit }, payload) {
    return new Promise((resolve, reject) => {
      const data = new FormData()
      data.append('name', 'image')
      data.append('file', payload)

      Vue.prototype.$http.post('upload/image_or_file', data, {
        onUploadProgress(progressEvent) {
          commit('UPDATE_UPLOADED_SIZE', parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100), 0))
        },
        headers: {
          'Content-Type': 'image/png',
        },
      }).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  uploadImage({ commit }, payload) {
    return new Promise((resolve, reject) => {
      const data = new FormData()
      data.append('name', 'image')
      data.append('file', payload)

      Vue.prototype.$http.post('upload/image', data, {
        onUploadProgress(progressEvent) {
          commit('UPDATE_UPLOADED_SIZE', parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100), 0))
        },
        headers: {
          'Content-Type': 'image/png',
        },
      }).then(response => {
        resolve(response)
      }).catch(error => {
        reject(error)
      })
    })
  },
  getImage(_, payload) {
    return new Promise((resolve, reject) => {
      Vue.prototype.$http.get(`upload/image/${payload.id}`)
        .then(response => {
          resolve(response)
        }).catch(error => {
          reject(error)
        })
    })
  },
  resetImage({ commit }, payload) {
    commit('SET_DEFAULT_IMAGE', payload.value)
  },
}
export default actions
