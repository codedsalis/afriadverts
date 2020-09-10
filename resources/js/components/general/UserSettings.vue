<template>
  <div>
    <div class="text-2xl md:text-3xl font-bold text-gray-900">Settings</div>

    <div class="flex justify-center w-full sm:overflow-x-scroll md:overflow-x-hidden">
      <div>
        <button
          v-bind:class="{'bg-white rounded-t-md shadow-md border-t-2 border-r-2 border-l-2 border-aa-light text-aa-light font-bold': active === 'account'}"
          class="px-3 py-2 focus:outline-none"
          @click="switchTab('account')"
        >Account</button>
      </div>
      <div>
        <button
          v-bind:class="{'bg-white rounded-t-md shadow-md border-t-2 border-r-2 border-l-2 border-aa-light text-aa-light font-bold': active === 'password'}"
          class="px-3 py-2 focus:outline-none"
          @click="switchTab('password')"
        >Password</button>
      </div>
      <div>
        <button
          v-bind:class="{'bg-white rounded-t-md shadow-md border-t-2 border-r-2 border-l-2 border-aa-light text-aa-light font-bold': active === 'payment'}"
          class="px-3 py-2 focus:outline-none"
          @click="switchTab('payment')"
        >Payment</button>
      </div>
    </div>

    <div
      id="tab-account"
      v-bind:class="{'hidden': active !== 'account'}"
      class="bg-white p-5 rounded-md shadow-md"
    >
      <account-settings :user="user"></account-settings>
    </div>

    <div
      id="tab-password"
      v-bind:class="{'hidden': active !== 'password'}"
      class="bg-white p-5 rounded-md shadow-md"
    >
      <password-settings :user="user"></password-settings>
    </div>

    <div
      id="tab-payment"
      v-bind:class="{'hidden': active !== 'payment'}"
      class="bg-white p-5 rounded-md shadow-md"
    >
      <payment-settings :user="user"></payment-settings>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],

  data() {
    return {
      active: "account",
    };
  },

  created() {
    // this.loadDefaultTab();
  },

  methods: {
    switchTab(tabToDisplay) {
      let activeTab = document.querySelector("#tab-" + this.active);
      activeTab.style.display = "none";

      let newTab = document.querySelector("#tab-" + tabToDisplay);
      newTab.style.display = "block";
      this.active = tabToDisplay;
    },
  },
};
</script>

<style scoped>
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>