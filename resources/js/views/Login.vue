<template>
  <b-row class="justify-content-md-center">
    <b-col cols="12" md="6" lg="4">
      <login-form />
    </b-col>
  </b-row>
</template>

<script>
import LoginForm from "../components/LoginForm.vue";

export default {
  name: "Login",

  components: {
    LoginForm
  }
};
</script>
