
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

import vuejquery from 'vue-jquery';
Vue.use(vuejquery);

import jquerymigrate from 'jquery-migrate';
Vue.use(jquerymigrate);

import InfiniteLoading from 'vue-infinite-loading';
Vue.use(InfiniteLoading);

import VueAxios from 'vue-axios';
import axios from 'axios';

import VueMoment from 'vue-moment';
import moment from 'moment-timezone';
moment.locale('id');
Vue.use(VueMoment, {
  moment,
});

import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0",
    libraries: "places" // necessary for places input
  }
});


import App from './components/layouts/App.vue';
Vue.use(VueAxios, axios);

import router from './router'

Vue.mixin({
  methods: {
    capitalizeFirstLetter: str => str.charAt(0).toUpperCase() + str.slice(1)
  }
})


new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>',
})


