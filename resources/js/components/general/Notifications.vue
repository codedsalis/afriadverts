<template>
  <div>
    <div v-if="isLoading">
      <div class="center">
        <div class="loader"></div>
      </div>
    </div>
    <!-- No notifications found -->
    <div v-if="notificationsMeta.total < 1">
      <div class="flex center flex-col justify-center">
        <div class="text-center" style="font-size: 50px">😑</div>
        <div class="text-center text-2xl">
          No notifications to display for now
        </div>
      </div>
    </div>
    <!-- End no notifications found -->
    <div
      v-if="notificationsMeta.total > 0"
      class="container md:w-2/3 bg-white rounded-lg shadow-md"
    >
      <div v-for="notif in notifications" :key="notif.id">
        <div class="px-4 py-3 hover:bg-gray-300 border-b-2 border-gray-300">
          <b class="font-bold text-gray-700"
            ><i class="fa fa-comments"></i> {{ notif.title }}</b
          ><br />
          {{ notif.message }}<br />
          <span class="text-gray-600 float-right">
            <small><i class="fa fa-calendar"></i></small>
            <show-date :date-val="notif.created_at"></show-date>
            <button
              class="bg-transparent px-3 py-2 focus:outline-none"
              @click="deleteNotification(notif.id)"
            >
              <i class="fa fa-trash text-red-600 hover:text-red-800"></i>
            </button>
          </span>
          <br />
        </div>
      </div>
    </div>
    <br />
    <!-- Begin pagination -->
    <div v-if="notificationsMeta.total > 10">
      <div class="flex justify-center">
        <button
          v-bind:class="[{ 'cursor-not-allowed': !pagination.prev_page_url }]"
          class="bg-white text-aa-dark border border-aa-light rounded-md px-5 py-2 hover:bg-gray-400 focus:outline-none"
          @click="fetchNotifications(pagination.prev_page_url)"
        >
          Previous
        </button>
        <div
          class="flex-2 bg-white text-aa-dark border border-gray-400 px-5 py-2 focus:outline-none"
        >
          Page {{ pagination.current_page }} of {{ pagination.last_page }}
        </div>
        <button
          v-bind:class="[{ 'cursor-not-allowed': !pagination.next_page_url }]"
          class="bg-white text-aa-dark border border-aa-light rounded-md px-5 py-2 hover:bg-gray-400 focus:outline-none"
          @click="fetchNotifications(pagination.next_page_url)"
        >
          Next
        </button>
      </div>
    </div>
    <!-- End pagination -->
  </div>
</template>

<script>
import axios from "axios";

//Import Noty for notifications
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";

import ShowDate from "../ShowDate";
export default {
  props: ["user"],

  components: {
    ShowDate,
  },

  data() {
    return {
      isLoading: true,
      notificationsMeta: "",
      notifications: "",
      pagination: {},
    };
  },

  created() {
    this.fetchNotifications();
  },

  methods: {
    fetchNotifications(pageUrl) {
      let vm = this;
      pageUrl = pageUrl || `/api/notifications?user_id=${this.user.id}`;
      axios
        .get(pageUrl)
        .then((response) => {
          this.isLoading = false;
          this.notificationsMeta = response.data;
          this.notifications = response.data.data;
          this.markNotificationsRead();
          vm.makePagination(response.data);
        })
        .catch((error) => {
          this.isLoading = false;
          console.log(error.response);
        });
    },

    makePagination(meta) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: meta.next_page_url + "&user_id=" + this.user.id,
        prev_page_url: meta.prev_page_url + "&user_id=" + this.user.id,
      };
      this.pagination = pagination;
    },

    markNotificationsRead() {
      axios
        .post("api/notifications", {
          user_id: this.user.id,
        })
        .then((response) => {})
        .catch((error) => console.log(error.response));
    },

    deleteNotification(id) {
      if (confirm("Confirm delete?")) {
        axios
          .delete(`/api/notification/${id}`)
          .then((response) => {
            console.log(response);
            this.$noty.success("Deleted successfully", {
              layout: "topRight",
              theme: "metroui",
            });
            this.fetchNotifications();
          })
          .catch((error) => console.log(error.response));
      }
    },
  },
};
</script>

<style>
</style>