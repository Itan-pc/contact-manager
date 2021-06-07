import Vue from "vue";
import {
  authorize,
  clearAuthorization,
  jwtDecode,
} from "../../helper/auth";

export default {
  state: {
    token: localStorage.getItem("token") || null,
    user: localStorage.getItem("token")
      ? jwtDecode(localStorage.getItem("token"))
      : {}
  },
  mutations: {
    setToken: (state, payload) => (state.token = payload),
    setUser: (state, payload) => (state.user = payload)
  },
  getters: {
    getToken: state => state.token,
    getUser: state => state.user,
    auth: state => {
      return {
        isAuthorized: !!Object.keys(state.user).length,
      };
    }
  },
  actions: {
    login({ commit }, user) {
      return new Promise((resolve, reject) => {
        Vue.prototype.$http
          .post("login", user)
          .then(response => {
            const token = response.data.access_token;
            authorize(commit, token);
            resolve(response);
          })
          .catch(error => {
            clearAuthorization(commit);
            reject(error);
          });
      });
    },
    logout({ commit }) {
      return new Promise(resolve => {
        clearAuthorization(commit);
        resolve();
      });
    },
    register({ commit }, user) {
      return new Promise((resolve, reject) => {
        Vue.prototype.$http
          .post("register", user)
          .then(response => {
            const token = response.data.access_token;
            authorize(commit, token);
            resolve(response);
          })
          .catch(error => {
            clearAuthorization(commit);
            reject(error);
          });
      });
    }
  }
};
