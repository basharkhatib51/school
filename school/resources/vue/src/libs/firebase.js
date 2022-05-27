import { initializeApp } from 'firebase/app'
import { getMessaging, getToken } from 'firebase/messaging'

const firebaseConfig = {
  apiKey: 'AIzaSyBzqTVm74oFVyY7Rw0_K2sClvN7rp1AM-I',
  authDomain: 'school-325320.firebaseapp.com',
  projectId: 'school-325320',
  storageBucket: 'school-325320.appspot.com',
  messagingSenderId: '674801055140',
  appId: '1:674801055140:web:dc803498aa9d38c44d3d31',
  measurementId: 'G-W3LXT7ZTBE',
}
const app = initializeApp(firebaseConfig)
const messaging = getMessaging()
getToken(messaging, { vapidKey: 'BER8zBFk7lvPSXiYntNNk0ZQEAgtdIJTM3d7-X0YiDU8l7-6JEZiuwEcuHMPbYkia7lYDKOvdxtZhe2YygkWOt0' }).then(currentToken => {
  if (currentToken) {
    // Send the token to your server and update the UI if necessary
    // ...
  } else {
    // Show permission request UI
    console.log('No registration token available. Request permission to generate one.')
    // ...
  }
})
export default app
