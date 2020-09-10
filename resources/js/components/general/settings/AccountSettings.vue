<template>
  <div class="sm:w-full md:w-9/12">
    <form method="post" @submit.prevent="saveChanges">
      <header class="text-2xl font-bold">Personal Info</header>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label for="first_name">First Name*</label>
          <br />
          <input
            id="first_name"
            type="text"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.first_name"
            placeholder="Enter first name"
            autofocus
            required
          />
          <br />
          <div
            v-for="firstNameError in error.first_name"
            v-bind:key="firstNameError"
            class="text-red-700"
          >{{ firstNameError }}</div>
        </div>

        <div>
          <label for="last_name">Last Name*</label>
          <br />
          <input
            id="last_name"
            type="text"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.last_name"
            placeholder="Enter last name"
            required
          />
          <br />
          <div
            v-for="lastNameError in error.last_name"
            v-bind:key="lastNameError"
            class="text-red-700"
          >{{ lastNameError }}</div>
        </div>

        <div>
          <label for="email">Email address*</label>
          <br />
          <input
            id="email"
            type="text"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.email"
            placeholder="Email address"
            required
            disabled
          />
        </div>

        <div>
          <label for="phone_number">Phone number</label>
          <br />
          <input
            inputmode="tel"
            id="phone_number"
            type="tel"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.phone_number"
            placeholder="Your phone number"
          />
          <br />
          <div
            v-for="phoneNumberError in error.phoneNumber"
            v-bind:key="phoneNumberError"
            class="text-red-700"
          >{{ phoneNumberError }}</div>
        </div>

        <div>
          <label for="country">Country*</label>
          <br />
          <input
            id="country"
            type="text"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.country"
            placeholder="Country"
            required
            disabled
          />
        </div>

        <div>
          <label for="address">Address:</label>
          <br />
          <input
            id="address"
            type="text"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.address"
            placeholder="Address"
          />
          <br />
          <div
            v-for="addressError in error.address"
            v-bind:key="addressError"
            class="text-red-700"
          >{{ addressError }}</div>
        </div>
      </div>
      <br />
      <submit-button :loading="isLoading">Save Changes</submit-button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

import SubmitButton from "../../SubmitButton.vue";

// not required. Styles for built-in spinner
import "vue-promise-btn/dist/vue-promise-btn.css";

//Import Noty for notifications
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";

export default {
  props: ["user"],

  components: {
    SubmitButton,
  },

  data() {
    return {
      isLoading: false,
      error: {
        user_id: null,
        first_name: null,
        last_name: null,
        phone_number: null,
        address: null,
      },
    };
  },
  methods: {
    saveChanges() {
      this.isLoading = true;
      axios
        .put(`/api/settings/account`, {
          userId: this.user.id,
          first_name: this.user.first_name,
          last_name: this.user.last_name,
          phone_number: this.user.phone_number,
          address: this.user.address,
        })
        .then((response) => {
          setTimeout(() => {
            this.isLoading = false;
            this.$noty.success("Changes successfully saved", {
              layout: "topRight",
              theme: "metroui",
            });
          }, 1000);
        })
        .catch((error) => {
          this.isLoading = false;
          error.response.data.indexOf("first_name")
            ? (this.error.first_name = error.response.data[0].first_name)
            : null;
          error.response.data.indexOf("last_name")
            ? (this.error.last_name = error.response.data[0].last_name)
            : null;
          error.response.data.indexOf("userId")
            ? (this.error.user_id = error.response.data[0].userId)
            : null;
          error.response.data.indexOf("address")
            ? (this.error.address = error.response.data[0].address)
            : null;
          error.response.data.indexOf("phone_number")
            ? (this.error.phone_number = error.response.data[0].phone_number)
            : null;
        });
    },
  },
};
</script>

<style>
</style>