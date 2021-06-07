import Vue from "vue";

export default {
  state: {
    contacts: [],
    contact: null
  },
  mutations: {
    setContacts: (state, payload) => (state.contacts = payload),
    setContact: (state, payload) => (state.contac = payload)
  },
  getters: {
    getContacts: state => state.contacts,
    getContact: state => state.contact,
  },
  actions: {
    loadContacts({ commit }) {
      return new Promise((resolve, reject) => {
        Vue.prototype.$http
          .get("contacts")
          .then(response => {
            commit("setContacts", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    loadContact({ commit }, id) {
      return new Promise((resolve, reject) => {
        Vue.prototype.$http
          .get("contacts/" + id)
          .then(response => {
            commit("setContact", response.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    saveContact({ commit }, data) {
      return new Promise((resolve, reject) => {
        Vue.prototype.$http
          .put("contacts/" + data.id, data)
          .then(response => {
            commit("setContact", response.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    createContact({ commit }, data) {
      return new Promise((resolve, reject) => {
        Vue.prototype.$http
          .post("contacts", data)
          .then(response => {
            commit("setContact", response.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    deleteContact({ commit, dispatch }, id) {
      return new Promise((resolve, reject) => {
        Vue.prototype.$http
          .delete("contacts/" + id)
          .then(response => {
            dispatch('loadContacts');
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
  }
};
