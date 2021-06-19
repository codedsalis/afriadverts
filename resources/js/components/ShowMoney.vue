<template>
  <span>
    {{ showMoney(this.moneyInKobo) }}
  </span>
</template>

<script>
export default {
  props: {
    moneyInKobo: {
      required: true,
      default: 0,
    },
    user: {
      type: Object,
      required: true,
    },
    useNaira: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  methods: {
    showMoney(amount) {
      if (!this.useNaira) {
        var amountInNaira = amount / 100;
      } else {
        var amountInNaira = amount;
      }

      if (this.user.currency == "NGN") {
        return new Intl.NumberFormat("en-NG", {
          style: "currency",
          currency: "NGN",
        }).format(amountInNaira);
      } else if (this.user.currency == "USD") {
        let amountInUsd = amountInNaira / 400;
        return new Intl.NumberFormat("en-US", {
          style: "currency",
          currency: "USD",
        }).format(amountInUsd);
      }
    },
  },
};
</script>