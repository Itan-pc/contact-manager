<template>
  <div>
    <b-table hover :fields="fields" :items="getContacts">
      <template #cell(actions)="row">
        <router-link :to="{name:'contact.edit', params: {id:row.item.id}}">Edit</router-link>
        <a href="#" @click="deleteContact(row.item.id)">Delete</a>
      </template>
    </b-table>
    <b-button type="submit" variant="dark">
      <router-link :to="{name: 'contact.add'}">Add contact</router-link>
    </b-button>
  </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  name: "ContactsTableComponent",

  computed: {
    ...mapGetters([
      'getContacts',
    ]),
  },

  data() {
    return {
      fields: [
        { key: 'id', label: 'ID'},
        { key: 'first_name', label: 'First name'},
        { key: 'phone_number', label: 'Phone number'},
        { key: 'email', label: 'Email'},
        { key: 'actions', label: 'Actions'},
      ]
    }
  },

  methods: {
    async loadContacts() {
      await this.$store.dispatch("loadContacts");
    },
    deleteContact(id) {
     this.$store.dispatch("deleteContact", id);
    }
  },

  mounted() {
    this.loadContacts();
  }
};
</script>
