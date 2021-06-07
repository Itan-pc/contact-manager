import Vue from "vue";
require('./bootstrap');
require('./components/bootstrap');
import Axios from "./axios";
import errorHandler from "./services/errorHandler";
import router from "./router";
import store from "./store";
import VeeValidate from 'vee-validate';

import "./assets/app.scss";

Vue.config.productionTip = false;

Vue.prototype.$http = Axios();
errorHandler(Vue.prototype.$http, store, router);

Vue.use(VeeValidate, {
  classes: true,
  classNames: {
    invalid: 'is-invalid',
    valid: 'is-valid'
  }
});

const token = store.getters.getToken;

if (token) {
  Vue.prototype.$http.defaults.headers.common["Authorization"] =
    "Bearer " + token;
}

new Vue({
  router,
  store,
  el: '#app',
});