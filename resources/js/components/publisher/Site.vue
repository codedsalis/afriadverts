<template>
  <div class="container mx-auto px-4">
    <div v-if="isLoading" class="center">
      <div class="loader"></div>
    </div>
    <div v-if="site">
      <div class="flex flex-wrap justify-between">
        <div class="text-2xl md:text-3xl font-bold text-gray-900">
          {{ site.url }}
          <div class="text-xs font-normal text-gray-600">
            Category: {{ site.category }}
            <b>&middot;</b>
            Created <show-date :date-val="site.created_at"></show-date>
          </div>
          <span v-if="site.verified > 0">
            <span class="bg-green-600 px-3 py-0 text-xs font-bold text-white rounded">Verified</span>
            <span
              v-if="site.approved > 0"
              class="bg-green-600 px-3 py-0 text-xs font-bold text-white rounded"
            >Approved</span>
            <span
              v-else-if="site.approved < 0"
              class="bg-red-700 px-3 py-0 text-xs font-bold text-white rounded"
            >Disapproved</span>
            <span
              v-else
              class="bg-orange-400 px-3 py-0 text-xs font-bold text-white rounded"
            >Pending Approval</span>
          </span>
          <span
            v-else
            class="bg-orange-400 px-3 py-0 text-xs font-bold text-white rounded"
          >Unverified</span>
        </div>
        <div>
          <a v-bind:href="'/p/site/' + site.id +'/newadunit'">
            <button
              class="px-4 py-2 bg-light-500 text-white text-sm border border-light-500 rounded-md hover:bg-light-700 focus:border-light-600 mt-2 shadow-md"
            >
              <i class="fa fa-plus"></i> New Ad Unit
            </button>
          </a>
        </div>
      </div>

      <!-- Verified site -->
      <div v-if="site.verified">
        <!-- Disapproved site -->
        <div
          v-if="site.approved < 0"
          class="bg-white text-black p-5 shadow-outline rounded mt-5 w-full md:w-4/6"
        >
          We are sorry, but your website is disapproved and the stated reason for it's disapproval is:
          <br />
          <br />
          {{ site.reason_unapproved }}
        </div>
        <!-- End of disapproved site -->

        <!-- Begin site pending approval -->
        <div
          v-else-if="site.approved === 0"
          class="bg-white rounded w-full md:w-4/6 border border-light-400 p-5 mt-5"
        >Your website is pending approval by our admins, kindly wait while they assess it, you'll hear from us within 24 hours time. Once it is approved, you'll be able to publish our ads on it</div>
        <!-- End of site pending approval -->

        <!-- Begin approved site -->
        <div v-if="site.approved > 0" class="mt-5">
          <ad-units v-bind:site-id="site.id"></ad-units>
        </div>
        <!-- End of approved site -->
      </div>

      <!-- Unverified site -->
      <div v-else class="md:w-3/5">
        <br />
        <b class="font-bold text-2xl">Verify your site</b>
        <br />To verify
        <b>{{ site.url }}</b>, copy the code below and paste in the
        <b>&lt;head&gt;....&lt;/head&gt;</b> section of the site and make sure nothing is edited. Thereafter, wait for it to be automatically verified. If the verification was successful, you will get a notification message telling you that it has been verified and vice versa.
        <br />
        <br />
        <b>Verification Code:</b>
        <br />
        <input
          id="vCode"
          type="text"
          class="px-3 py-2 rounded-r-none rounded-l-md border-2 border-gray-400 focus:border-dark-800 w-4/6"
          v-bind:value="site.verification_code"
        />
        <button
          v-on:click="copy"
          class="bg-aa-dark text-white border-2 border-aa-dark rounded-l-none rounded-r-md hover:bg-aa-darker hover:border-aa-darker px-3 py-2"
        >Copy</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

//Import Noty for notifications
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";

import AdUnits from "./AdUnits.vue";
import ShowDate from '../ShowDate';

export default {
  props: ["user", "siteId"],

  components: {
    AdUnits,
  },

  data() {
    return {
      isLoading: true,
      site: null,
      createdDate: null,
    };
  },

  created() {
    this.fetchSite();
  },

  methods: {
    fetchSite() {
      axios
        .get(`/api/site/${this.siteId}`)
        .then((response) => {
          this.isLoading = false;
          this.site = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    copy() {
      const vCode = document.querySelector("#vCode");
      vCode.select();
      try {
        const copy = document.execCommand("Copy");
        this.$noty.success("Verification code copied to clipboard", {
          layout: "bottomRight",
          theme: "nest",
        });
      } catch (err) {
        this.$noty.error("There was an error copying code", {
          layout: "topRight",
          theme: "nest",
        });
      }
    },
  },
};
</script>