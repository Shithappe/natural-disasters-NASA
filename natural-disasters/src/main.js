import Vue from 'vue'
import App from './App.vue'
import store from './store'

Vue.config.productionTip = false

import * as VueGoogleMaps from "vue2-google-maps" // Import package

Vue.config.productionTip = false

Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyAoxuKbl-hjeqiD_MjDzbY0WyjlrWHL11U",
    libraries: "places"
  }
});

new Vue({
  render: h => h(App),
  store
}).$mount('#app')
