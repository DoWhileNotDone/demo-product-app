<template>

  <div class="w-full mx-auto z-10">
    <!-- Search Panel -->
    <div>
      <div class="bg-white flex items-center rounded-3x shadow-xl">
        <input v-model="search" class="rounded-l-full w-full py-4 px-6 text-gray-500 leading-tight focus:outline-none" id="search" type="text" placeholder="Search">
        <button @click="searchItems" class="bg-green-500 hover:bg-green-700 disabled:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
          Search
        </button>
        <button @click="clearSearch" class="bg-blue-500 hover:bg-blue-700 disabled:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
          Clear
        </button>
      </div>
    </div>
    <!-- List Items -->
    <div v-for="item in laravelData.data" :key="item.id">
      <div class="flex flex-col">
        <div class="bg-white hover:bg-gray-100 border border-white hover:border-gray-100 shadow-lg rounded-3xl p-4 m-4">
          <div class="flex-none sm:flex text-gray-500 leading-tight">
            {{ item.name }}
          </div>
        </div>
      </div>
    </div>
    <pagination :data="laravelData" @pagination-change-page="getData"></pagination>
  </div>

</template>

<script>
  
  import axios from 'axios';
  import Pagination from 'laravel-vue-pagination';

  export default {
    name: "DataList",
    components: {
      Pagination,
    },
    props: {
        getUrl: {
            type: String,
            required: true
        },
    },    
    data() {
        return {
            laravelData: {
              data: [],
            },
            search: '',
        }
    },
    created: function () {
      this.getData();
    },
    methods: {
      async getData(page = 1) {
        const { data } = await axios.get(`${this.getUrl}?page=${page}&query=${this.search}`)
        this.laravelData = data
      },
      searchItems() {
        this.getData(1);
      },
      clearSearch() {
        this.search = '';
        this.searchItems();
      }
    }    
  }

</script>