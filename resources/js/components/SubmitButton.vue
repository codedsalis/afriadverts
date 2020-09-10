<template>
  <button
    type="submit"
    v-bind:class="{'cursor-not-allowed opacity-75 text-gray-300': loading}"
    class="bg-aa-dark rounded-md text-white font-bold px-5 py-2 hover:bg-aa-darker focus:outline-none border-b-4 border-aa-darker hover:border-dark-900"
  >
    <div class="flex">
      <div class="px-1">
        <div v-bind:class="{'spinner': loading}"></div>
      </div>
      <div>
        <slot>Submit</slot>
      </div>
    </div>
  </button>
</template>

<script>
export default {
  name: "SubmitButton",

  props: {
    loading: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
};
</script>