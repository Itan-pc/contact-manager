import Vue from "vue";
import JWT from "jwt-decode";

const setToken = (commit, token) => {
  localStorage.setItem("token", token);
  commit("setToken", token);
};

const removeToken = commit => {
  localStorage.removeItem("token");
  commit("setToken", null);
};

const updateAuthorizationHeader = token => {
  Vue.prototype.$http.defaults.headers.common["Authorization"] = token;
};

export const jwtDecode = JWT;

export const clearAuthorization = commit => {
  commit("setUser", {});
  removeToken(commit);
  updateAuthorizationHeader("");
};

export const authorize = (commit, token) => {
  const user = jwtDecode(token);
  setToken(commit, token);
  updateAuthorizationHeader("Bearer " + token);
  commit("setUser", user);
};
