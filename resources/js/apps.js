import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import "./bootstrap";

window.Vue = require('vue');

Vue.component('app', require('./App.vue').default);
Vue.component('v-header', require('./components/Header.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App)
}).$mount("#apps");

