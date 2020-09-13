<template>
  <div class="sm:w-full md:w-9/12">
    <br />
    <br />
    <form method="post" @submit.prevent="saveChanges">
      <div
        class="text-md font-medium"
      >Provide your bank details below for processing your publisher payments</div>
      <br />

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label for="bank_name">Bank name</label>
          <br />
          <input
            id="bank_name"
            type="text"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.bank_name"
            placeholder="Bank name"
            autofocus
            required
          />
          <br />
          <div
            v-for="bank_name_error in error.bank_name"
            v-bind:key="bank_name_error"
            class="text-red-700 animate__animated animate__shakeX"
          >{{ bank_name_error }}</div>
        </div>

        <div>
          <label for="account_name">Account Name</label>
          <br />
          <input
            id="account_name"
            type="text"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.account_name"
            placeholder="Account name"
            required
          />
          <br />
          <div
            v-for="account_name_error in error.account_name"
            v-bind:key="account_name_error"
            class="text-red-700 animate__animated animate__shakeX"
          >{{ account_name_error }}</div>
        </div>

        <div>
          <label for="account_number">Account Number</label>
          <br />
          <input
            id="account_number"
            inputmode="numeric"
            type="number"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.account_number"
            placeholder="Account number"
            required
          />
          <br />
          <div
            v-for="account_number_error in error.account_number"
            v-bind:key="account_number_error"
            class="text-red-700 animate__animated animate__shakeX"
          >{{ account_number_error }}</div>
        </div>
      </div>
      <br />
      <submit-button v-bind:loading="isLoading">Save</submit-button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

import SubmitButton from "../../../SubmitButton.vue";

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
        account_name: null,
        account_number: null,
        bank_name: null,
      },
    };
  },

  methods: {
    saveChanges() {
      this.isLoading = true;
      axios
        .put("/api/settings/payment", {
          payment_method: "bank",
          user_id: this.user.id,
          bank_name: this.user.bank_name,
          account_name: this.user.account_name,
          account_number: this.user.account_number,
        })
        .then((response) => {
          setTimeout(() => {
            this.isLoading = false;
            this.$noty.success("Bank settings saved", {
              layout: "topRight",
              theme: "metroui",
            });
          }, 1000);
        })
        .catch((error) => {
          this.isLoading = false;
          error.response.data.indexOf("bank_name")
            ? (this.error.bank_name = error.response.data[0].bank_name)
            : null;
          error.response.data.indexOf("user_id")
            ? (this.error.user_id = error.response.data[0].user_id)
            : null;
          error.response.data.indexOf("account_name")
            ? (this.error.account_name = error.response.data[0].account_name)
            : null;
          error.response.data.indexOf("account_number")
            ? (this.error.account_number =
                error.response.data[0].account_number)
            : null;
        });
    },
  },
};
</script>