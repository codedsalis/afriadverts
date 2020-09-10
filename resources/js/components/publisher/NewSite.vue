<template>
  <div class="vld-parent">
    <loading :active.sync="isLoading" :can-cancel="false" :is-full-page="fullPage"></loading>
    <div class="container px-5 md:px-0 w-full md:w-2/4">
      <br />
      <form @submit.prevent="addNewSite">
        <input
          type="url"
          inputmode="url"
          class="text-black rounded border-2 border-gray-400 p-3 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker"
          v-model="site.url"
          placeholder="Domain name (ex: https://yourdomain.com)"
          autofocus
          required
        />
        <br />
        <div v-for="urlError in error.url" v-bind:key="urlError" class="text-red-700">{{ urlError }}</div>
        <div class="flex flex-wrap justify-between mt-2">
          <div>
            <label for="category">Website Category:</label>
            <select
              id="category"
              v-model="site.category"
              class="bg-white rounded p-3 border-2 border-gray-400 text-black w-full"
            >
              <option value="General">General</option>
              <option value="Technology">Technology</option>
              <option value="ecommerce">e-Commerce</option>
              <option value="portfolio">Portfolio</option>
              <option value="personal">Personal</option>
              <option value="forum">Forum</option>
              <option value="Business">Business</option>
              <option value="Entertainment">Entertainment</option>
              <option value="Beauty and fashion">Beauty and fashion</option>
              <option value="Education">Education</option>
              <option value="nonprofit">Non Profit</option>
              <option value="Religion">Religion</option>
              <option value="Health and fitness">Health and fitness</option>
              <option value="Sports">Sports</option>
              <option value="Others">Others</option>
            </select>
            <br />
            <div
              v-for="categoryError in error.category"
              v-bind:key="categoryError"
              class="text-red-700"
            >{{ categoryError }}</div>
          </div>
          <div>
            <button
              type="submit"
              class="animation transform bg-aa-dark px-10 duration-500 py-3 text-white float-right hover:scale-200 hover:bg-aa-darker rounded-full mt-4"
            >Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

// Import component
import Loading from "vue-loading-overlay";

// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";

//Import Noty for notifications
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";

export default {
  props: ["user"],

  data() {
    return {
      isLoading: false,
      fullPage: true,
      site: {
        url: "",
        user_id: this.user.id,
        category: "General",
      },
      error: {
        url: null,
        user_id: null,
        category: null,
      },
    };
  },

  components: {
    Loading,
  },

  methods: {
    addNewSite() {
      this.isLoading = true;
      axios
        .post("/api/site", {
          url: this.site.url,
          category: this.site.category,
          userId: this.site.user_id,
        })
        .then((response) => {
          setTimeout(() => {
            this.isLoading = false;
            this.$noty.success(
              'Site added successfully<br/><br/><a href="/p/site/' +
                response.data.data.id +
                '"><button class="bg-dark-500 text-gray-100 px-5 py-2 font-bold rounded hover:bg-dark-800">View</button></a>',
              {
                layout: "topRight",
                theme: "metroui",
              }
            );
          }, 500);
        })
        .catch((error) => {
          this.isLoading = false;
          error.response.data.indexOf("url")
            ? (this.error.url = error.response.data[0].url)
            : null;
          error.response.data.indexOf("category")
            ? (this.error.category = error.response.data[0].category)
            : null;
          error.response.data.indexOf("userId")
            ? (this.error.user_id = error.response.data[0].userId)
            : null;
        });
    },
  },
};
</script>
