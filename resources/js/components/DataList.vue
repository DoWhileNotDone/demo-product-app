<template>

  <div class="w-full mx-auto z-10">
    <!-- Search Panel -->
    <div>
      <div class="bg-white flex items-center rounded-3x shadow-xl">
        <input v-model="search" class="rounded-l-full w-full py-4 px-6 text-gray-500 leading-tight focus:outline-none" id="search" type="text" placeholder="Search name and brand">
        <button @click="searchItems" class="bg-green-500 hover:bg-green-700 disabled:bg-gray-500 text-white font-bold py-2 px-4 mx-2 rounded focus:outline-none focus:shadow-outline" type="button">
          Search
        </button>
        <button @click="clearSearch" class="bg-blue-500 hover:bg-blue-700 disabled:bg-gray-500 text-white font-bold py-2 px-4 mx-2 rounded focus:outline-none focus:shadow-outline" type="button">
          Clear
        </button>
      </div>
    </div>
    <!-- List Items -->
    <card-item v-for="item in laravelData.data" :key="item.id" :item="item" />
    <pagination :data="laravelData" @pagination-change-page="getData"></pagination>
  </div>

</template>

<script>
  
  import axios from 'axios';
  import CardItem from './CardItem.vue'
  import Pagination from 'laravel-vue-pagination';

  export default {
    name: "DataList",
    components: {
      CardItem,
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