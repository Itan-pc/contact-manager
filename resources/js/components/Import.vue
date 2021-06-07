<template>
    <b-form @submit.prevent="sendForm">
        <b-form-group id="input-group-username">
            <input
              id="file"
              name="file"
              type="file"
              accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
              required
              placeholder="File"
              @change="onFileChange"
            >
        </b-form-group>

        <p>Fields : first_name, email, phone_number</p>

        <b-button type="submit" variant="dark">Import</b-button>
    </b-form>
</template>

<script>
    export default {
        name: "Import",
        data: function() {
          return {
              file:null,
          }
        },
        components: {},
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.file = files[0];
            },
            sendForm(isValid){
                if(isValid) {
                    let formData = new FormData();
                    formData.append("file", this.file);
                    this.$http.post('contacts/import', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(() => {
                        this.$store.dispatch('loadContacts');
                    }).catch((errors) => {
                        console.log(errors)
                    });
                }
            }

        },
        mounted() {

        }
    }
</script>
