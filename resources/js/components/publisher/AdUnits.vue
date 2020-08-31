<template>
<div>
    <div v-if="isLoading">
        <div class="loader"></div>
    </div>
    <div class="text-2xl font-semibold">{{ adunits.total }} Ad Units</div>
    <!-- <table class="table-fixed border-collapse overflow-scroll">
        <thead>
            <tr>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">ID</th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">Title</th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">Ad type</th>
                <th class="px-4 py-2 text-gray-800 font-bold text-lg">Created</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="unit in adunit" v-bind:key="unit.id">
                <td class="px-4 py-2 text-black">{{ unit.id }}</td>
                <td class="px-4 py-2 text-black"><a href="" class="text-aa-light hover:text-aa-light-active">{{ unit.unit_title }}</a></td>
                <td class="px-4 py-2 text-black">{{ unit.advert_type }}</td>
                <td class="px-4 py-2 text-black">
                    <show-date :date-val="unit.created_at"></show-date>
                </td>
                <td><a href="" class="text-aa-light hover:text-aa-light-active"><i class="fa fa-pie-chart"></i> Statistics</a> &#160;&#160;&#160;<a href="" class="text-aa-light hover:text-aa-light-active"><i class="fa fa-code"></i> Ad Code</a> &#160;&#160;&#160;<a href="" class="text-red-700 hover:text-red-900"><i class="fa fa-trash"></i> Delete</a></td>
            </tr>
        </tbody>
    </table> -->

    <table class="table-auto border-collapse w-full flex flex-row flex-no-wrap rounded-lg overflow-hidden sm:shadow-sm my-5">
        <thead class="text-gray-900">
            <tr class="flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="px-4 py-2 text-left md:font-bold">ID</th>
                <th class="px-4 py-2 text-left md:font-bold">Title</th>
                <th class="px-4 py-2 text-left md:font-bold">Ad type</th>
                <th class="px-4 py-2 text-left md:font-bold">Created</th>
                <th class="px-4 py-2 text-left md:font-bold">Actions</th>
            </tr>
            <!-- <tr class="flex flex-col flex-no wrap sm:invisible rounded-l-lg sm:rounded-none mb-2 sm:mb-0 md:visible">
                <th class="px-4 py-2 text-left md:font-bold">ID</th>
                <th class="px-4 py-2 text-left md:font-bold">Title</th>
                <th class="px-4 py-2 text-left md:font-bold">Ad type</th>
                <th class="px-4 py-2 text-left md:font-bold">Created</th>
                <th class="px-4 py-2 text-left md:font-bold">Actions</th>
            </tr> -->
        </thead>
        <tbody class="flex-1 sm:flex-none">
            <tr v-for="unit in adunit" v-bind:key="unit.id" class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <td class="hover:bg-gray-300 px-4 py-2">{{ unit.id }}</td>
                <td class="hover:bg-gray-300 px-4 py-2 truncate"><a href="" class="text-aa-light hover:text-aa-light-active">{{ unit.unit_title }}</a></td>
                <td class="hover:bg-gray-300 px-4 py-2 text-black hover:font-medium cursor-pointer">{{ unit.advert_type }}</td>
                <td class="hover:bg-gray-300 px-4 py-2 text-black hover:font-medium cursor-pointer">
                    <show-date :date-val="unit.created_at"></show-date>
                </td>
                <td class="hover:bg-gray-300 px-4 py-2 text-black hover:font-medium cursor-pointer"><a href="" class="text-aa-light hover:text-aa-light-active"><i class="fa fa-pie-chart"></i> Statistics</a> &#160;&#160;&#160;<a href="" class="text-aa-light hover:text-aa-light-active"><i class="fa fa-code"></i> Ad Code</a> &#160;&#160;&#160;<a href="" class="text-red-700 hover:text-red-900"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
import ShowDate from '../ShowDate';
export default {
    props: ["siteId"],

    data() {
        return {
            isLoading: true,
            adunits: '',
            adunit: {
                created_at: ''
            },
        };
    },

    created() {
        this.fetchAdUnits();
    },

    methods: {
        fetchAdUnits() {
            axios
                .get(`/api/site/${this.siteId}/adunits`)
                .then((response) => {
                    this.isLoading = false;
                    this.adunits = response.data;
                    this.adunit = response.data.data;
                })
                .catch((error) => console.log(error.response));
        },
    },
};
</script>

<style>
html,
body {
    height: 100%;
}

@media (min-width: 640px) {
    table {
        display: inline-table !important;
    }
/* 
    /* thead tr:not(:first-child) {
        display: none;
    } 

    th {
    font-weight: bolder;
} */
}

th {
    font-weight: normal;
}
</style>
