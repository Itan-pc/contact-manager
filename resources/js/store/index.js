import Vue from "vue";
import Vuex from "vuex";
import auth from "./modules/auth";
import contacts from "./modules/contacts";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    loading: false
  },
  getters: {
    getLoading: state => state.loading
  },
  mutations: {
    setLoading: (state, payload) => (state.loading = payload)
  },
  modules: {
    auth,
    contacts
  },
  strict: true
});
