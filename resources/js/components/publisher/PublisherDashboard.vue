<template>
  <div>
    <div v-if="user.verified === 0">
      <div class="flex flex-col items-center text-black p-5">
        <div class="w-3/4 text-xl">
          Hey, {{ user.first_name }} {{ user.last_name }}, you have not been
          verified. Add a new site and follow the instructions to get your
          account verified, after which you can start publishing ads on your
          website
        </div>
        <div>
          <br />
          <a :href="'/p/newsite'">
            <button
              class="bg-light-500 text-white rounded-md animation py-3 px-10 hover:scale-105 hover:bg-light-600 focus:bg-light-600 focus:outline-none"
            >
              Add a Site
              <i class="fa fa-arrow-right"></i>
            </button>
          </a>
        </div>
      </div>
    </div>
    <div v-else class="bg-white rounded border border-gray-400 text-black p-5">
      {{ site.url }}
    </div>
  </div>
</template>


<script>
import axios from "axios";
export default {
  props: ["user"],
  data() {
    return {
      sites: [],
      hasNoSites: true,
      link: "",
    };
  },

  //   props: {
  //     userId: Number,
  //   },

  created() {
    this.fetchSites();
  },

  methods: {
    fetchSites() {
      axios
        .get(`/api/sites/user/${this.userId}?paginate`)
        .then((response) => {
          this.sites = response.data.data;
          this.link = response.data.current_page;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
