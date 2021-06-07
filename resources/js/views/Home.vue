<template>
  <div class="home">
    <ContactsTableComponent></ContactsTableComponent>
    <br>
    <import></import>
  </div>
</template>

<script>

import ContactsTableComponent from "../components/ContactsTableComponent";
import Import from "../components/Import";
export default {
  name: "Home",
  components: {Import, ContactsTableComponent}
};
</script>
