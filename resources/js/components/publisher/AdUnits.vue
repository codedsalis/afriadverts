<template>
  <div>
    <div v-if="isLoading">
      <div class="loader"></div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["siteId"],

  data() {
    return {
      isLoading: true,
      adunits: [],
      adunit: "",
    };
  },

  created() {
    this.fetchAdUnits();
  },

  methods: {
    fetchAdUnits() {
      axios
        .get(`/api/site/${this.siteId}/adunits/`)
        .then((response) => {
          this.isLoading = false;
          console.log(response.data);
        })
        .catch((error) => console.log(error.response));
    },
  },
};
</script>