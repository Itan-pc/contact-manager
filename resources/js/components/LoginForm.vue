<template>
  <b-form @submit.prevent="login">
    <h1>Sign In</h1>

    <b-form-group id="input-group-username">
      <b-form-input
        id="input-username"
        v-model="email"
        type="email"
        required
        placeholder="Email"
      ></b-form-input>
    </b-form-group>

    <b-form-group id="input-group-password">
      <b-form-input
        id="input-password"
        v-model="password"
        type="password"
        required
        placeholder="Password"
      ></b-form-input>
    </b-form-group>

    <b-button type="submit" variant="dark">Log In</b-button>
    <b-button type="submit" variant="white">
      <router-link :to="{name: 'register'}">Register</router-link>
    </b-button>
  </b-form>
</template>
<script>
export default {
  name: "LoginForm",

  data() {
    return {
      email: null,
      password: null
    };
  },

  methods: {
    async login() {
      const { email, password } = this;
      await this.$store
        .dispatch("login", { email, password })
        .then(() => this.$router.push({name:"home"}));
    }
  }
};
</script>
