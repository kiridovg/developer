import Vue from "vue";

window.Vue = require('vue');

Vue.component('v-header', require('./components/Header.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

import router from "./router";

const apps = new Vue({
    el: '#apps',
    router
});
