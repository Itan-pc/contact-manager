<template>
  <b-row class="justify-content-md-center">
    <b-col cols="12" md="6" lg="4">
      <register-form />
    </b-col>
  </b-row>
</template>

<script>
import RegisterForm from "../components/RegisterForm.vue";

export default {
  name: "Register",

  components: {
    RegisterForm
  }
};
</script>
