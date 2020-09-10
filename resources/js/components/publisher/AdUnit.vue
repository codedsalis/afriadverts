<template>
<div class="sm:w-full mx-2 md:w-2/3">
    <div v-if="isLoading" class="center">
        <div class="loader"></div>
    </div>
    <div v-if="adUnit">
        <div v-for="adUnit in adUnit" :key="adUnit.id">
            <header class="text-2xl md:text-3xl font-bold text-gray-900">
                {{ adUnit.unit_title }}
                <div class="text-sm font-medium text-gray-700">
                    Display type: {{ adUnit.advert_type }} Ad
                </div>
            </header>
            <br />
            <div class="w-full md:w-4/5">
                <i class="text-aa-light fa fa-lightbulb-o"></i> Copy the code below and paste in the appropriate section of your site where you want the advert to be displayed to your visitors
            </div>
            <br />
            <br />

            <b>Ad Code:</b><br />
            <div v-if="adUnit.advert_type === 'Carousel'">
                <div class="sm:w-full mx-4 md:w-4/5">
                    <div class="code">
                        <code id="vCode">&lt;teekay data-name="afriPageAds" id="page-{{ adUnit.id }}"&gt;&lt;/teekay&gt;&lt;script src="https://static.afriadverts.com/js/pagead.js"&gt;&lt;/script&gt;&lt;script&gt;(function loadPageAds() {
                            return afriPageAds({
                            'pid': {{ user.id }},
                            'uid': {{ adUnit.id }},
                            'type': '{{ adUnit.advert_type }}',
                            'url': '{{ adUnit.url }}'
                            });
                            }());&lt;/script&gt;</code>
                    </div>
                    <button class="bg-aa-dark py-2 px-3 rounded text-white float-right mt-1" id="button1" @click="copyToClipboard('vCode')">Copy</button>
                </div>
            </div>

            <div v-else-if="adUnit.advert_type === 'Responsive'">
                <div class="sm:w-full mx-4 md:w-4/5">
                    <div class="code">
                        <code id="vCode">&lt;teekay data-name="afriRespoAds" id="respo-{{ adUnit.id }}"&gt;&lt;/teekay&gt;&lt;script src="https://static.afriadverts.com/js/respoads.js"&gt;&lt;/script&gt;&lt;script&gt;(function loadRespoAds() {
                            return afriRespoAds({
                            'pid': {{ user.id }},
                            'uid': {{ adUnit.id }},
                            'type': '{{ adUnit.advert_type }}',
                            'url': '{{ adUnit.url }}'
                            });
                            }());&lt;/script&gt;</code>
                    </div>
                    <button class="bg-aa-dark py-2 px-3 rounded text-white float-right mt-1" id="button1" @click="copyToClipboard('vCode')">Copy</button>
                </div>
            </div>

            <div v-else>
                <div class="sm:w-full mx-4 md:w-4/5">
                    <div class="code">
                        <code id="vCode">&lt;teekay data-name="afriPageAds" id="page-{{ adUnit.id }}"&gt;&lt;/teekay&gt;&lt;script src="https://static.afriadverts.com/js/pagead.js"&gt;&lt;/script&gt;&lt;script&gt;(function loadPageAds() {
                            return afriPageAds({
                            'pid': {{ user.id }},
                            'uid': {{ adUnit.id }},
                            'type': '{{ adUnit.advert_type }}',
                            'url': '{{ adUnit.url }}'
                            });
                            }());&lt;/script&gt;</code>
                    </div>
                    <button class="bg-aa-dark py-2 px-3 rounded text-white float-right mt-1" id="button1" @click="copyToClipboard('vCode')">Copy</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

//Import Noty for notifications
import VueNoty from "vuejs-noty";

Vue.use(VueNoty);

//Import noty styles
import "vuejs-noty/dist/vuejs-noty.css";
export default {
    props: ["user", "unitId"],

    data() {
        return {
            isLoading: true,
            adUnit: {
                advert_type: '',
            },
        }
    },

    created() {
        this.fetchAdUnit();
    },

    methods: {
        fetchAdUnit() {
            axios.get(`/api/adunit/${this.unitId}`)
                .then(response => {
                    this.isLoading = false;
                    this.adUnit = response.data.data;
                })
                .catch(error => {
                    console.log(error.response);
                })
        },

        copyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("copy");
            } else if (window.getSelection) {
                var range = document.createRange();
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("copy");
                this.$noty.success("Ad code copied to clipboard", {
                    layout: "bottomRight",
                    theme: "nest",
                });
            }
        },
    }

}
</script>

<style>

</style>
