<template>
  <span>
      {{ showDate(dateVal) }}
  </span>
</template>

<script>
export default {
    props: ['dateVal'],

    methods: {
        showDate(date) {
            date = new Date(date);
            return date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear();
        }
    }
}
</script>