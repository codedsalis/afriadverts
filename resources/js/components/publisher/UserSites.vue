<template>
  <div class="vld-parent">
    <loading
      :active.sync="isLoading"
      :can-cancel="false"
      :is-full-page="fullPage"
    ></loading>

    <div class="flex justify-between">
      <div class="text-2xl md:text-3xl font-bold text-gray-900">My sites</div>
      <a v-bind:href="'/p/newsite/'">
        <button
          class="px-4 py-2 bg-light-500 text-white font-bold text-sm rounded-lg hover:bg-light-700 focus:border-light-600 mt-2 shadow-md focus:outline-none border-b-4 border-light-600 hover:border-aa-light-active"
        >
          <i class="fa fa-plus"></i> New site
        </button>
      </a>
    </div>
    <br />

    <!-- Begin no sites found -->
    <div v-if="sitesMeta.total < 1">
      <div class="flex center flex-col justify-center">
        <div class="text-center" style="font-size: 50px">😑</div>
        <div class="text-center text-2xl">
          You do not have any sites to display. Click on the New site button to
          create one
        </div>
      </div>
    </div>
    <!-- End no sites found -->

    <!-- Begin sites -->
    <div v-else>
      <div
        class="container px-4 py-3 md:px-5 w-full bg-white rounded-lg shadow-md"
      >
        <div class="overflow-x-scroll w-full">
          <table class="table table-auto border-collapse">
            <thead>
              <tr>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">URL</th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">ID</th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                  Category
                </th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                  Status
                </th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                  Created
                </th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                  <i class="fa fa-pie-chart"></i>
                </th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                  <i class="fa fa-plus"></i>
                </th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">
                  <i class="fa fa-trash"></i>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="site in sites" v-bind:key="site.id">
                <td class="px-4 py-2 text-black">
                  <a
                    :href="`/p/site/${site.id}`"
                    class="text-aa-light hover:text-aa-light-active"
                    >{{ site.url }}</a
                  >
                </td>
                <td class="px-4 py-2 text-black">{{ site.id }}</td>
                <td class="px-4 py-2 text-black">{{ site.category }}</td>
                <td class="px-4 py-2 text-black">
                  <span v-if="site.verified > 0">
                    <span
                      class="bg-green-600 rounded text-xs font-bold px-2 text-white"
                      >VERIFIED</span
                    >
                    <span
                      v-if="site.approved > 0"
                      class="bg-green-600 rounded text-xs font-bold px-2 text-white"
                      >APPROVED</span
                    >
                    <span
                      v-else-if="site.approved === 0"
                      class="bg-orange-400 rounded text-xs font-bold px-2 text-white"
                      >PENDING APPROVAL</span
                    >
                    <span
                      v-else
                      class="bg-red-700 rounded text-xs font-bold px-2 text-white"
                      >DISAPPROVED</span
                    >
                  </span>
                  <span
                    v-if="site.verified === 0"
                    class="bg-orange-400 rounded text-xs font-bold px-2 text-white"
                    >UNVERIFIED</span
                  >
                </td>
                <td class="px-4 py-2 text-black">
                  <show-date :date-val="site.created_at"></show-date>
                </td>
                <td class="px-4 py-2 text-black">
                  <a
                    :href="`/p/site/${site.id}/statistics`"
                    class="text-aa-light hover:text-aa-light-active"
                    >Statistics</a
                  >
                </td>
                <td class="px-4 py-2 text-black">
                  <a
                    :href="`/p/newadunit/${site.id}`"
                    class="text-aa-light hover:text-aa-light-active"
                    >New ad unit</a
                  >
                </td>
                <td class="px-4 py-2 text-black">
                  <button
                    v-on:click="deleteSite(site.id)"
                    class="bg-red-700 focus:outline-none text-white px-2 py-1 rounded-md hover:bg-red-900"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br />
      <!-- Begin pagination -->
      <div v-if="sitesMeta.total > 10">
        <div class="flex justify-center">
          <button
            v-bind:class="[{ 'cursor-not-allowed': !pagination.prev_page_url }]"
            class="bg-white text-aa-dark border border-aa-light rounded-md px-5 py-2"
            @click="fetchSites(pagination.prev_page_url)"
          >
            Previous
          </button>
          <div
            class="flex-2 bg-white text-aa-dark border border-gray-400 px-5 py-2"
          >
            Page {{ pagination.current_page }} of {{ pagination.last_page }}
          </div>
          <button
            v-bind:class="[{ 'cursor-not-allowed': !pagination.next_page_url }]"
            class="bg-white text-aa-dark border border-aa-light rounded-md px-5 py-2"
            @click="fetchSites(pagination.next_page_url)"
          >
            Next
          </button>
        </div>
      </div>
      <!-- End pagination -->
    </div>
    <!-- End sites -->
  </div>
</template>

<script>
import axios from "axios";

// Import component
import Loading from "vue-loading-overlay";

import ShowDate from "../ShowDate";

import Modal from "../Modal";

//Import Noty for notifications
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";

export default {
  props: ["user"],

  components: {
    Loading,
    ShowDate,
  },

  data() {
    return {
      isLoading: false,
      fullPage: true,
      showModal: false,
      sites: [],
      sitesMeta: {},
      pagination: "",
    };
  },

  created() {
    this.fetchSites();
  },

  methods: {
    toggleModal() {
      this.showModal = !this.showModal;
    },

    fetchSites(pageUrl) {
      let vm = this;
      pageUrl = pageUrl || `${this.$root.$data.api}/sites/${this.user.id}`;
      this.isLoading = true;
      axios
        .get(pageUrl)
        .then((response) => {
          this.isLoading = false;
          this.sites = response.data.data;
          this.sitesMeta = response.data;
          vm.makePagination(response.data);
        })
        .catch((error) => console.log(error.response));
    },

    makePagination(meta) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: meta.next_page_url,
        prev_page_url: meta.prev_page_url,
      };

      this.pagination = pagination;
    },

    deleteSite(id) {
      if (confirm("Are you sure you want to delete this site?")) {
        axios
          .delete(`/api/site/${id}`)
          .then((response) => {
            this.$noty.success("Site deleted successfully", {
              layout: "topRight",
              theme: "metroui",
            });
            this.fetchSites();
          })
          .catch((error) => console.log(error));
      }
    },
  },
};
</script>

<style>
</style>