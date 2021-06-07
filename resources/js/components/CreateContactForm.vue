<template>
  <b-form @submit.prevent="saveContract">
    <h1>Edit/Create contact</h1>

    <b-form-group id="input-group-username">
      <b-form-input
        id="input-username"
        v-model="contact.first_name"
        type="text"
        required
        placeholder="First name"
      ></b-form-input>
    </b-form-group>
    <b-form-group v-if="!isEditPage()" id="input-group-email">
      <b-form-input
        id="input-email"
        v-model="contact.email"
        type="email"
        required
        placeholder="Email"
      ></b-form-input>
    </b-form-group>

    <b-form-group id="input-group-password">
      <b-form-input
        id="input-password"
        v-model="contact.phone_number"
        type="text"
        required
        placeholder="Phone number"
      ></b-form-input>
    </b-form-group>

    <b-button type="submit" variant="dark">Save</b-button>
    <b-button type="button" variant="white">
      <router-link :to="{name:'home'}">Home</router-link>
    </b-button>
  </b-form>
</template>
<script>
export default {
  name: "CreateContactForm",

  data() {
    return {
      contact: {
        first_name: null,
        email: null,
        phone_number: null,
      }
    };
  },

  methods: {
    async saveContract() {
      let action = 'createContact';
      let data = Object.assign({}, this.contact);

      if (this.isEditPage()) {
        action = 'saveContact';
        data.id = this.$route.params.id;
      }

      await this.$store
        .dispatch(action, data).then(res=> {
          if (res.data){
            this.contact = Object.assign({}, this.contact, res.data.data);
          }
        });
    },

    isEditPage(){
      return this.$route.name === 'contact.edit';
    },

    async loadContact() {
      await this.$store
        .dispatch('loadContact', this.$route.params.id).then(res=> {
          if (res.data){
            this.contact = Object.assign({}, this.contact, res.data.data);
          }
        });
    }
  },
  created() {
    if (this.isEditPage()) {
      this.loadContact();
    }
  }
};
</script>
