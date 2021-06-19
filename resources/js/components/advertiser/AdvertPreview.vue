<template>
  <div>
    <!-- Begin Image format -->
    <div v-if="advert.ad_format == 'image'">
      <img
        :src="
          this.$root.$data.banners +
          '/' +
          advert.advert_token.substring(0, 25) +
          '/' +
          shuffleBanners(images)[4]
        "
      />
    </div>
    <!-- End of image ad format -->

    <!-- Begin Carousel format -->
    <div v-if="advert.ad_format == 'carousel'">
      <carousel-3d
        :autoplay="true"
        :autoplay-timeout="3000"
        :perspective="0"
        :display="3"
      >
        <slide :index="0">
          <img
            :src="
              this.$root.$data.banners +
              '/' +
              advert.advert_token.substring(0, 25) +
              '/' +
              images[0]
            "
          />
        </slide>
        <slide :index="1">
          <img
            :src="
              this.$root.$data.banners +
              '/' +
              advert.advert_token.substring(0, 25) +
              '/' +
              images[1]
            "
          />
        </slide>
        <slide :index="2">
          <img
            :src="
              this.$root.$data.banners +
              '/' +
              advert.advert_token.substring(0, 25) +
              '/' +
              images[2]
            "
          />
        </slide>
        <slide :index="3">
          <img
            :src="
              this.$root.$data.banners +
              '/' +
              advert.advert_token.substring(0, 25) +
              '/' +
              images[3]
            "
          />
        </slide>
        <slide :index="4">
          <img
            :src="
              this.$root.$data.banners +
              '/' +
              advert.advert_token.substring(0, 25) +
              '/' +
              images[4]
            "
          />
        </slide>
      </carousel-3d>
      <div class="flex justify-between bg-gray-300 px-3 py-2">
        <div class="text-aa-dark text-xl font-bold mt-2">
          {{ advert.sub_text }}
        </div>
        <button
          v-bind:class="{
            'bg-link-100': advert.advert_type == 'website',
            'bg-green-600': advert.advert_type == 'phone' || 'whatsapp',
          }"
          class="py-3 px-5 rounded-md text-white font-bold hover:bg-linkk-700 focus:outline-none"
        >
          <i
            v-bind:class="{
              'fa fa-whatsapp': advert.advert_type == 'whatsapp',
              'fa fa-phone': advert.advert_type == 'phone',
            }"
          ></i>
          {{ advert.action_button }}
        </button>
      </div>
    </div>
    <!-- End of Carousel ad format -->

    <!-- Begin Responsive ad format -->
    <div v-if="advert.ad_format == 'responsive'">
      <img
        :src="
          this.$root.$data.banners +
          '/' +
          advert.advert_token.substring(0, 25) +
          '/' +
          shuffleBanners(images)[4]
        "
      />
      <div class="flex justify-between bg-gray-300 px-3 py-2">
        <div class="text-aa-dark text-xl font-bold mt-2">
          {{ advert.sub_text }}
        </div>
        <button
          v-bind:class="{
            'bg-link-100': advert.advert_type == 'website',
            'bg-green-600': advert.advert_type == 'phone' || 'whatsapp',
          }"
          class="py-3 px-5 rounded-md text-white font-bold hover:bg-linkk-700 focus:outline-none"
        >
          <i
            v-bind:class="{
              'fa fa-whatsapp': advert.advert_type == 'whatsapp',
              'fa fa-phone': advert.advert_type == 'phone',
            }"
          ></i>
          {{ advert.action_button }}
        </button>
      </div>
    </div>
    <!-- End of responsive ad format -->
  </div>
</template>

<script>
import { Carousel3d, Slide } from "vue-carousel-3d";
export default {
  props: ["advert"],
  components: {
    Carousel3d,
    Slide,
  },
  data() {
    return {
      images: this.advert.ad_images.split(","),
    };
  },
  methods: {
    shuffleBanners(images) {
      let ctr = images.length - 1;
      let temp;
      let index;

      // While there are elements in the array
      while (ctr > 0) {
        // Pick a random index
        index = Math.floor(Math.random() * ctr);
        // Decrease ctr by 1
        ctr--;
        // And swap the last element with it
        temp = images[ctr];
        images[ctr] = images[index];
        images[index] = temp;
      }
      return images;
    },
  },
};
</script>