<template>
  <div>
    <div class="flex justify-between">
      <div class="text-3xl md:text-4xl p-3 font-bold text-aa-dark">
        Advert statistics
        <!-- <br /> -->
        <p class="text-sm font-normal">
          for
          <a :href="'?info=info&escv=' + Math.random()" class="text-link-100"
            ><b>{{ advert.ad_title }}</b></a
          >
        </p>
      </div>
      <div class="py-5">
        Display:<br />
        <select
          v-on:change="handleChange()"
          class="p-3 bg-white text-link-100 rounded border-2 border-gray-300 focus:outline-none focus:border-link-100"
        >
          <option :value="'past-one-week'">Past one Week</option>
          <option :value="'past-one-month'">Past one Month</option>
          <option :value="'previous-month'">Previous Month</option>
          <option :value="'all-time'">All time</option>
        </select>
      </div>
    </div>
    <br />
    <div class="text-aa-dark font-bold text-xl p-3">
      <i class="fa fa-area-chart"></i> Reach and engagement
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
      <div class="rounded bg-linkk-600 p-6 hover:bg-linkk-700">
        <div class="text-gray-300 float-right">Today so far</div>
        <br /><br />
        <div
          class="grid grid-cols-2 text-gray-300"
          v-if="todayIsLoading == false"
        >
          <div class="font-bold text-3xl">
            {{ this.formatNumber(stats.today.all_clicks) }}
            <p class="font-small text-sm">clicks</p>
          </div>
          <div class="font-bold text-3xl">
            {{ this.formatNumber(stats.today.all_impressions) }}
            <p class="font-small text-sm">impressions</p>
          </div>
        </div>
        <div v-else>
          <div class="loader"></div>
        </div>
      </div>
      <div
        class="rounded bg-linkk-600 p-6 hover:bg-linkk-700"
        @click="getAdvertStatistics('past-one-week')"
      >
        <div class="text-gray-300 float-right">The past one week</div>
        <br /><br />
        <div class="grid grid-cols-2 text-gray-300">
          <div class="font-bold text-3xl">
            {{ this.formatNumber(stats.all_clicks) }}
            <p class="font-small text-sm">clicks</p>
          </div>
          <div class="font-bold text-3xl">
            {{ this.formatNumber(stats.all_impressions) }}
            <p class="font-small text-sm">impressions</p>
          </div>
        </div>
      </div>
      <div
        class="rounded col-span-3 md:col-span-1 bg-linkk-600 p-6 hover:bg-linkk-700"
        @click="getAdvertStatistics('all-time')"
      >
        <div class="text-gray-300 float-right">All time</div>
        <br /><br />
        <div class="grid grid-cols-2 text-gray-300">
          <div class="font-bold text-3xl">
            {{ this.formatNumber(advert.ad_clicks) }}
            <p class="font-small text-sm">clicks</p>
          </div>
          <div class="font-bold text-3xl">
            {{ this.formatNumber(advert.ad_impressions) }}
            <p class="font-small text-sm">impressions</p>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div id="chart">
      <div v-if="loading == true">
        <div class="center">
          <div class="loader"></div>
        </div>
      </div>
      <apexchart
        v-if="loading == false"
        type="line"
        height="350"
        :options="chartOptions"
        :series="series"
      ></apexchart>
    </div>
    <br />
    <div class="text-aa-dark font-bold text-xl p-3">
      <i class="fa fa-credit-card"></i> Spending
    </div>
    <div class="shadow w-full bg-gray-300 rounded-full">
      <div
        v-bind:class="{
          'bg-gray-300 text-aa-dark':
            spent_percentage == 0 || spent_percentage < 1,
          'bg-blue-500 text-white': spent_percentage > 0,
          'bg-green-500 text-white': spent_percentage > 70,
        }"
        class="text-xs leading-none py-1 text-center text-white rounded-full"
        :style="'width:' + spent_percentage + '%'"
      >
        {{ spent_percentage.toFixed(1) }}% spent
      </div>
    </div>
    <div class="flex justify-center text-aa-dark p-3">
      <div class="p-6 bg-gray-300 rounded-l-md w-1/2 mr-1">
        <p class="float-right">Amount spent</p>
        <br />
        <b class="font-bold text-3xl">
          <show-money
            :user="this.user"
            :moneyInKobo="advert.used_budget"
          ></show-money>
        </b>
      </div>
      <div class="p-6 bg-gray-300 rounded-r-md w-1/2">
        <p class="float-right">Total budget</p>
        <br />
        <b class="font-bold text-3xl text-center">
          <show-money
            :user="this.user"
            :moneyInKobo="advert.ad_budget"
          ></show-money>
        </b>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import VueApexCharts from "vue-apexcharts";
import ShowMoney from "../ShowMoney.vue";
export default {
  props: ["user", "advert"],

  components: {
    apexchart: VueApexCharts,
    ShowMoney,
  },

  data() {
    return {
      loading: true,
      todayIsLoading: true,
      spent_percentage: (this.advert.used_budget * 100) / this.advert.ad_budget,
      stats: {
        today: {
          all_clicks: 0,
          all_impressions: 0,
        },
        all_clicks: 0,
        all_impressions: 0,
      },
      series: [
        {
          name: "clicks",
          data: [],
        },
        {
          name: "impressions",
          data: [],
        },
      ],
      chartOptions: {
        fill: {
          colors: ["#3b5998", "#36a8da", "#9C27B0"],
        },
        colors: ["#b45f06", "#2c3e50", "#3b5998"],
        chart: {
          height: 350,
          type: "area",
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "straight",
        },
        xaxis: {
          type: "datetime",
          categories: [],
          //     labels: {
          //   //     format: "dd/MM",
          //     },
        },
        yaxis: [
          {
            axisBorder: {
              show: true,
              color: "#247BA0",
            },
          },
        ],
        tooltip: {
          x: {
            format: "dd/MM/yyyy",
          },
        },
      },
    };
  },

  created() {
    this.getAdvertStatistics();
    this.getAdvertStatistics("today");
  },

  methods: {
    getAdvertStatistics(ranges) {
      if (ranges == "today") {
        this.todayIsLoading = true;
      } else {
        this.loading = true;
      }

      ranges = ranges || "past-one-week";

      axios
        .post(`${this.$root.$data.api}/adverts/statistics/${this.advert.id}`, {
          user_id: this.user.id,
          ranges: ranges,
        })
        .then((response) => {
          if (ranges == "today") {
            this.todayIsLoading = false;
          } else {
            this.loading = false;
          }
          let data = response.data.data;
          if (ranges == "today") {
            this.setTodayStats(data);
          } else {
            this.getSeries(data, ranges);
          }
        })
        .catch((error) => {
          if (ranges == "today") {
            this.todayIsLoading = false;
          } else {
            this.loading = false;
          }
          console.log(error.response);
        });
    },

    getSeries(data, ranges) {
      let clicks = [];
      let allClicks = 0;
      let impressions = [];
      let allImpressions = 0;
      let day = [];
      for (let i = 0; i < data.length; i++) {
        clicks.push(data[i].clicks_counter);
        allClicks += data[i].clicks_counter;
        impressions.push(data[i].impressions_counter);
        allImpressions += data[i].impressions_counter;
        day.push(data[i].day);
      }
      this.series[0].data = clicks;
      this.series[1].data = impressions;

      if (ranges == "past-one-week") {
        this.stats.all_clicks = allClicks;
        this.stats.all_impressions = allImpressions;
      }

      this.chartOptions.xaxis.categories = day;
    },

    setTodayStats(data) {
      let allClicks = 0;
      let allImpressions = 0;
      for (let i = 0; i < data.length; i++) {
        allClicks += data[i].clicks_counter;
        allImpressions += data[i].impressions_counter;
      }
      this.stats.today.all_clicks = allClicks;
      this.stats.today.all_impressions = allImpressions;
    },

    handleChange() {
      let selected = document.querySelector("select").value;
      this.getAdvertStatistics(selected);
    },

    formatNumber(number) {
      if (number < 1e3) return number;
      if (number >= 1e3 && number < 1e6)
        return +(number / 1e3).toFixed(1) + "K";
      if (number >= 1e6 && number < 1e9)
        return +(number / 1e6).toFixed(1) + "M";
      if (number >= 1e9 && number < 1e12)
        return +(number / 1e9).toFixed(1) + "B";
      if (number >= 1e12) return +(number / 1e12).toFixed(1) + "T";
    },
  },
};
</script>