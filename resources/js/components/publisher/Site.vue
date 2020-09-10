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
            Created
            <show-date :date-val="site.created_at"></show-date>
          </div>
          <span v-if="site.verified > 0">
            <span class="bg-green-600 px-3 py-0 text-xs font-bold text-white rounded">VERIFIED</span>
            <span
              v-if="site.approved > 0"
              class="bg-green-600 px-3 py-0 text-xs font-bold text-white rounded"
            >APPROVED</span>
            <span
              v-else-if="site.approved < 0"
              class="bg-red-700 px-3 py-0 text-xs font-bold text-white rounded"
            >DISAPPROVED</span>
            <span
              v-else
              class="bg-orange-400 px-3 py-0 text-xs font-bold text-white rounded"
            >PENDING APPROVAL</span>
          </span>
          <span
            v-else
            class="bg-orange-400 px-3 py-0 text-xs font-bold text-white rounded"
          >UNVERIFIED</span>
        </div>
        <div>
          <a v-if="site.approved > 0" v-bind:href="'/p/newadunit/' + site.id">
            <button
              class="px-4 py-2 bg-light-500 text-white font-bold text-sm rounded-lg hover:bg-light-700 focus:border-light-600 mt-2 shadow-md focus:outline-none border-b-4 border-light-600 hover:border-aa-light-active"
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
        <div class="sm:w-full mx-4 md:w-4/5">
          <div class="code">
            <code
              id="vCode"
            >&lt;meta name="afri_verification" content="{{ site.pub_key }}"/&gt; &lt;script src="https://static.afriadverts.com/js/pubvfpv.js"&gt;&lt;/script&gt;&lt;script&gt;window.onload = function() { var url = "{{ site.url }}"; var pid = {{ user.id }}; var key = "{{ site.pub_key }}"; return renderPageViews({ url: url, pid: pid, key: key });};&lt;/script&gt;</code>
          </div>
          <button
            class="bg-aa-dark py-2 px-3 rounded text-white float-right mt-1"
            id="button1"
            @click="copyToClipboard('vCode')"
          >Copy</button>
        </div>
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
import ShowDate from "../ShowDate";

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

    copyToClipboard(containerid) {
      if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().createTextRange();
        document.execCommand("copy");
      } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().addRange(range);
        document.execCommand("copy");
        this.$noty.success("Verification code copied to clipboard", {
          layout: "bottomRight",
          theme: "nest",
        });
      }
    },
  },
};
</script>

<style>
code {
  font-family: monospace;
  /* color: crimson; */
  background-color: #f1f1f1;
  padding: 2px;
  font-size: 105%;
}

.code {
  height: 70px;
  overflow-y: scroll;
  overflow-x: hidden;
  padding: 5px;
  background: #f1f1f1;
  border: 2px solid;
  border-color: #cbd5e0;
  border-color: rgba(203, 213, 224, var(--border-opacity));
  border-radius: 5px;
}

.wrapper {
  width: 80%;
}
</style>
