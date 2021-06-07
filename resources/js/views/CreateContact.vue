<template>
  <b-row class="justify-content-md-center">
    <b-col cols="12" md="6" lg="4">
      <create-contact-form />
    </b-col>
  </b-row>
</template>

<script>
import CreateContactForm from "../components/CreateContactForm.vue";

export default {
  name: "CreateContact",

  components: {
    CreateContactForm
  }
};
</script>
