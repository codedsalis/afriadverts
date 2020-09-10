<template>
<div class="vld-parent">
    <loading :active.sync="isLoading" :can-cancel="false" :is-full-page="fullPage"></loading>
    <div class="container px-5 md:px-0 w-full md:w-2/4">
        <i class="text-aa-light fa fa-lightbulb-o"></i> Create a new ad unit to display adverts on your website<br /><br />
        <form @submit.prevent="createNewAdunit">
            <input type="text" class="text-black rounded border-2 border-gray-400 p-3 w-full focus:transform focus:animation hover:animation hover:transform focus:border-2 focus:border-aa-darker" v-model="adunit.title" placeholder="Unit title" autofocus required />
            <br />
            <div v-for="titleError in error.title" v-bind:key="titleError" class="text-red-700">{{ titleError }}</div>
            <div class="flex flex-wrap justify-between mt-2">
                <div>
                    <label for="advertType">Ad Type</label>
                    <select id="advertType" v-model="adunit.advertType" class="rounded p-3 border-2 border-gray-400 text-black w-full bg-white">
                        <option value="Image">Image Ads</option>
                        <option value="Carousel">Carousel Ads</option>
                        <option value="Responsive">Responsive ads</option>
                    </select>
                    <br />
                    <div v-for="adUnitError in error.adVertType" v-bind:key="adUnitError" class="text-red-700">{{ adUnitError }}</div>
                </div>
                <div>
                    <button type="submit" class="animation transform bg-aa-dark px-10 duration-500 py-3 text-white float-right hover:scale-200 hover:bg-aa-darker hover:shadow-xl rounded-full mt-4">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
</template>

<script>
import axios from 'axios';

// Import component
import Loading from "vue-loading-overlay";

// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";

//Import Noty for notifications
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";

export default {
    props: ["user", "siteId"],

    components: {
        Loading,
    },

    data() {
        return {
            isLoading: false,
            fullPage: true,
            adunit: {
                siteId: this.siteId,
                userId: this.user.id,
                advertType: 'Image',
                title: '',
            },
            error: {
                title: null,
                advertType: null,
                // category: null,
            },
        }
    },

    methods: {
        createNewAdunit() {
            this.isLoading = true;
            axios.post('/api/adunit', {
                    title: this.adunit.title,
                    advertType: this.adunit.advertType,
                    userId: this.adunit.userId,
                    siteId: this.adunit.siteId,
                })
                .then(response => {
                    setTimeout(() => {
                        this.isLoading = false;
                        this.$noty.success(
                            'Ad unit added successfully<br/><br/><a href="/p/adunit/' +
                            response.data.data.id +
                            '"><button class="bg-dark-500 text-gray-100 px-5 py-2 font-bold rounded hover:bg-dark-800">View</button></a>', {
                                layout: "topRight",
                                theme: "metroui",
                            }
                        );
                    }, 500);
                })
                .catch(error => {
                    this.isLoading = false;
                    error.response.data.indexOf("title") ?
                        (this.error.title = error.response.data[0].title) :
                        null;
                    error.response.data.indexOf("advertType") ?
                        (this.error.advertType = error.response.data[0].advertType) :
                        null;
                    // error.response.data.indexOf("userId") ?
                    //     (this.error.user_id = error.response.data[0].userId) :
                    //     null;
                })
        }
    }

}
</script>
