<template>
  <b-form @submit.prevent="register">
    <h1>Register</h1>

    <b-form-group id="input-group-username">
      <b-form-input
        id="input-username"
        v-model="name"
        type="text"
        required
        v-validate="'required'"
        placeholder="Name"
      ></b-form-input>
      <div class="invalid-feedback">{{ errors.first('name') }}</div>
    </b-form-group>
    <b-form-group id="input-group-email">
      <b-form-input
        id="input-email"
        v-model="email"
        type="email"
        required
        v-validate="'required'"
        placeholder="Email"
      ></b-form-input>
    </b-form-group>

    <b-form-group id="input-group-password">
      <b-form-input
        id="input-password"
        v-model="password"
        type="password"
        required
        v-validate="'required'"
        placeholder="Password"
      ></b-form-input>
    </b-form-group>

    <b-form-group id="input-group-password_confirmation">
      <b-form-input
        id="input-password_confirmation"
        v-model="password_confirmation"
        type="password"
        required
        v-validate="'required'"
        placeholder="Password confirmation"
      ></b-form-input>
    </b-form-group>

    <b-button type="submit" variant="dark">Register</b-button>
    <b-button type="submit" variant="white">
      <router-link :to="{name: 'login'}">Sign In</router-link>
    </b-button>
  </b-form>
</template>
<script>
export default {
  name: "RegisterForm",

  data() {
    return {
      name: null,
      email: null,
      password: null,
      password_confirmation: null
    };
  },

  methods: {
    async register() {
      const { name, email, password, password_confirmation } = this;

      await this.$store
        .dispatch("register", { name, email, password, password_confirmation })
        .then(() => this.$router.push({ name: "home" }));
    },
    validateState(name) {
      const { $dirty, $error } = this.$validator.form[name];
      return $dirty ? !$error : null;
    },
  }
};
</script>
