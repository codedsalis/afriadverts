<template>
  <div>
    <button
      v-on:click="deleteAdvert()"
      class="bg-red-700 focus:outline-none text-white px-2 py-1 rounded-md hover:bg-red-900"
    >
      Delete
    </button>
  </div>
</template>

<script>
import axios from "axios";
import VueNoty from "vuejs-noty";
import "vuejs-noty/dist/vuejs-noty.css";
export default {
  props: ["user_id", "advert_id"],
  methods: {
    deleteAdvert() {
      if (
        confirm(
          "Are you sure you want to delete this advert? This action cannot be reversed"
        )
      ) {
        axios
          .delete(`${this.$root.$data.api}/adverts`, {
            data: {
              advert_id: this.advert_id,
              user_id: this.user_id,
            },
          })
          .then((response) => {
            this.$noty.success("Successfully deleted", {
              layout: "topRight",
              theme: "metroui",
            });
            setTimeout(() => {
              window.location.reload();
            }, 300);
          })
          .catch((error) => {
            console.log(error.response);
          });
      }
    },
  },
};
</script>

<style>
</style>