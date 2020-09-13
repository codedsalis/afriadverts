<template>
  <div class="sm:w-full md:w-9/12">
    <header class="text-2xl font-bold">Payment Info/Methods</header>
    <br />Select a payment method
    <br />
    <select
      id="method"
      v-on:change="switchForms(paymentMethod)"
      v-model="paymentMethod"
      class="rounded p-3 border-2 border-gray-400 text-black w-2/4 bg-white focus:outline-none"
    >
      <option value="bank">Bank Transfer</option>
      <option value="paypal">Paypal</option>
    </select>
    <br />
    <div v-bind:class="{'hidden': paymentMethod !== 'bank'}">
      <bank v-bind:user="user"></bank>
    </div>

    <div v-bind:class="{'hidden': paymentMethod !== 'paypal'}">
      <pay-pal v-bind:user="user"></pay-pal>
    </div>
  </div>
</template>

<script>
import Bank from "./payment-methods/Bank.vue";

import PayPal from "./payment-methods/PayPal.vue";

export default {
  props: ["user"],

  components: {
    Bank,
    PayPal,
  },

  data() {
    return {
      isLoading: false,
      paymentMethod: "bank",
      error: {
        password: null,
        password_confirm: null,
      },
    };
  },

  methods: {
    switchForms(value) {},

    saveChanges() {
      this.isLoading = true;
      axios
        .put("/api/settings/password", {
          userId: this.user.id,
          password: this.user.password,
          password_confirmation: this.user.password_confirmation,
        })
        .then((response) => {
          setTimeout(() => {
            this.isLoading = false;
            this.$noty.success("Password changed successfully", {
              layout: "topRight",
              theme: "metroui",
            });
          }, 1000);
        })
        .catch((error) => {
          this.isLoading = false;
          error.response.data.indexOf("password")
            ? (this.error.password = error.response.data[0].password)
            : null;
          error.response.data.indexOf("userId")
            ? (this.error.user_id = error.response.data[0].userId)
            : null;
        });
    },
  },
};
</script>