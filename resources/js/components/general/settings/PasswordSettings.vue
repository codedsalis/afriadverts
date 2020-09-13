<template>
  <div class="sm:w-full md:w-9/12">
    <form method="post" @submit.prevent="saveChanges">
      <header class="text-2xl font-bold">Change password</header>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label for="password">Password*</label>
          <br />
          <input
            id="password"
            type="password"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.password"
            placeholder="password"
            autofocus
            required
          />
          <br />
          <div
            v-for="passwordError in error.password"
            v-bind:key="passwordError"
            class="text-red-700 animate__animated animate__shakeX"
          >{{ passwordError }}</div>
        </div>

        <div>
          <label for="password_confirmation">Confirm password*</label>
          <br />
          <input
            id="password_confirmation"
            type="password"
            class="text-black rounded border-2 border-gray-400 px-5 py-2 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker focus:outline-none"
            v-model="user.password_confirmation"
            placeholder="Confirm password"
            required
          />
          <br />
          <div
            v-for="passwordConfirmError in error.password_confirm"
            v-bind:key="passwordConfirmError"
            class="text-red-700 animate__animated animate__shakeX"
          >{{ passwordConfirmError }}</div>
        </div>
      </div>
      <br />
      <submit-button v-bind:loading="isLoading">Save Changes</submit-button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

import SubmitButton from "../../SubmitButton.vue";

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
        password: null,
        password_confirm: null,
      },
    };
  },

  methods: {
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