<template>
  <div class="sm:w-full md:w-9/12">
    <br />
    <br />
    <form method="post" @submit.prevent="saveEmail">
      <div
        class="text-md font-medium"
      >Provide your paypal email address below for processing your publisher payments</div>
      <br />

      <label for="paypal_email">Paypal email</label>
      <br />
      <input
        id="paypal_email"
        type="email"
        class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
        v-model="user.paypal_email"
        placeholder="Paypal email"
        autofocus
        required
      />
      <br />
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
        paypal_email: null,
      },
    };
  },

  methods: {
    saveEmail() {
      this.isLoading = true;
      axios
        .put("/api/settings/payment", {
          payment_method: "paypal",
          user_id: this.user.id,
          paypal_email: this.user.paypal_email,
        })
        .then((response) => {
          setTimeout(() => {
            this.isLoading = false;
            this.$noty.success("email address saved", {
              layout: "topRight",
              theme: "metroui",
            });
          }, 1000);
        })
        .catch((error) => {
          this.isLoading = false;
          error.response.data.indexOf("paypal_email")
            ? (this.error.paypal_email = error.response.data[0].paypal_email)
            : null;
          error.response.data.indexOf("user_id")
            ? (this.error.user_id = error.response.data[0].user_id)
            : null;
        });
    },
  },
};
</script>