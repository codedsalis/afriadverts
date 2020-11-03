<template>
  <button
    type="submit"
    v-bind:class="{ 'cursor-not-allowed opacity-75 text-gray-300': loading }"
    class="bg-aa-light rounded-md text-white font-bold py-3 px-5 hover:bg-light-700 focus:outline-none border border-aa-light hover:border-light-700"
  >
    <div class="flex">
      <div class="px-1">
        <div v-bind:class="{ spinner: loading }"></div>
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