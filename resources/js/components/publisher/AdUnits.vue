<template>
  <div>
    <div v-if="isLoading">
      <div class="loader"></div>
    </div>
    <!-- Begin no ad units found -->
    <div v-if="adunits.total < 1">
      <div class="flex center flex-col justify-center">
        <div class="text-center" style="font-size: 50px">😑</div>
        <div class="text-center text-2xl">
          You do not have any Ad units to display. Click on the New ad unit
          button to create one
        </div>
      </div>
    </div>
    <!-- End no ad units found -->

    <div v-if="adunits.total > 0">
      <div class="text-2xl font-semibold mb-0">
        {{ adunits.total }}/3 Ad Unit(s)
      </div>
      <div class="mb-2">
        <i class="fa fa-lightbulb-o text-aa-light"></i>
        A site may not have more than a maximum of
        <b>three(3)</b> Ad units
      </div>
    </div>

    <div
      v-if="adunits.total > 0"
      class="container px-4 py-3 md:px-5 w-full bg-white rounded-lg shadow"
    >
      <div class="overflow-x-scroll w-full">
        <table class="w-full table-auto border-collapse overflow-scroll">
          <thead>
            <tr>
              <th class="px-4 py-2 text-gray-800 text-left font-bold text-lg">
                ID
              </th>
              <th class="px-4 py-2 text-gray-800 text-left font-bold text-lg">
                Title
              </th>
              <th class="px-4 py-2 text-gray-800 text-left font-bold text-lg">
                Ad type
              </th>
              <th class="px-4 py-2 text-gray-800 text-left font-bold text-lg">
                Created
              </th>
              <th class="px-4 py-2 text-gray-800 text-left font-bold text-lg">
                Actions
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="unit in adunit" v-bind:key="unit.id" class="text-left">
              <td class="px-4 py-2 text-black">{{ unit.id }}</td>
              <td width="40%" class="px-4 py-2 text-black">
                <a
                  :href="'/p/adunit/' + unit.id"
                  class="text-aa-light hover:text-aa-light-active"
                  >{{ unit.unit_title }}</a
                >
              </td>
              <td class="px-4 py-2 text-black">{{ unit.advert_type }}</td>
              <td class="px-4 py-2 text-black">
                <show-date :date-val="unit.created_at"></show-date>
              </td>
              <td>
                <a href class="text-aa-light hover:text-aa-light-active">
                  <i class="fa fa-pie-chart"></i> Statistics
                </a>
                &#160;&#160;&#160;
                <a
                  @click="deleteAdUnit(unit.id)"
                  class="text-red-700 hover:text-red-900"
                  href="#"
                >
                  <i class="fa fa-trash"></i> Delete
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <br />
  </div>
</template>

<script>
import ShowDate from "../ShowDate";
export default {
  props: ["siteId"],

  components: {
    ShowDate,
  },

  data() {
    return {
      isLoading: true,
      adunits: "",
      adunit: {
        created_at: "",
      },
    };
  },

  created() {
    this.fetchAdUnits();
  },

  methods: {
    fetchAdUnits() {
      axios
        .get(`/api/site/${this.siteId}/adunits`)
        .then((response) => {
          this.isLoading = false;
          this.adunits = response.data;
          this.adunit = response.data.data;
        })
        .catch((error) => console.log(error.response));
    },

    deleteAdUnit(id) {
      if (confirm("Are you sure you want to delete this ad unit?")) {
        axios
          .delete(`/api/adunit/${id}`)
          .then((response) => {
            this.$noty.success("Ad unit deleted successfully", {
              layout: "topRight",
              theme: "metroui",
            });
            this.fetchAdUnits();
          })
          .catch((error) => console.log(error));
      }
    },
  },
};
</script>

<style>
html,
body {
  height: 100%;
}

@media (min-width: 640px) {
  table {
    display: inline-table !important;
  }

  /* 
    /* thead tr:not(:first-child) {
        display: none;
    } 

    th {
    font-weight: bolder;
} */
}

th {
  font-weight: normal;
}
</style>
