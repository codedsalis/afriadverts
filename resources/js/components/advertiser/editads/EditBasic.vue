<template>
  <div>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3">
      <div>
        <label for="objective">Advert Objective:</label>
        <select
          id="objective"
          v-model="form.objective"
          class="bg-white p-3 border-2 w-full border-gray-300 rounded-md focus:outline-none focus:border-link-100"
        >
          <option :value="'website'">Drive traffic to your website</option>
          <option :value="'phone'">Get phone call(s)</option>
          <option :value="'whatsapp'">Get Whatsapp message(s)</option>
        </select>
      </div>
      <div>
        <label for="format">Display format:</label>
        <select
          id="format"
          v-model="form.format"
          class="bg-white p-3 border-2 w-full border-gray-300 rounded-md focus:outline-none focus:border-link-100"
        >
          <option :value="'image'">Image ad format</option>
          <option :value="'carousel'">Carousel ad format</option>
          <option :value="'responsive'">Responsive ad format</option>
        </select>
      </div>
    </div>
    <br />
    <div class="flex justify-end">
      <button
        @click="saveBasicChanges()"
        v-bind:class="{
          'cursor-not-allowed opacity-75 text-gray-300': formIsLoading,
        }"
        class="bg-light-500 text-white font-bold rounded-md px-5 py-3 hover:bg-light-600 focus:outline-none"
      >
        <div class="flex">
          <div class="px-1">
            <div v-bind:class="{ spinner: formIsLoading }"></div>
          </div>
          <div>Save changes</div>
        </div>
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

//Import Noty for notifications
import VueNoty from "vuejs-noty";

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";

export default {
  props: ["user", "advert"],
  data() {
    return {
      formIsLoading: false,
      form: {
        objective: this.advert.advert_type,
        format: this.advert.ad_format,
      },
    };
  },
  methods: {
    saveBasicChanges() {
      this.formIsLoading = true;
      axios
        .put(`${this.$root.$data.api}/adverts`, {
          user_id: this.user.id,
          advert_id: this.advert.id,
          portion: "basic",
          advert_intent: this.form.objective,
          format: this.form.format,
        })
        .then((response) => {
          this.formIsLoading = false;
          console.log(response);
        })
        .catch((error) => {
          this.formIsLoading = false;
          console.log(error.response);
        });
    },
  },
};
</script>