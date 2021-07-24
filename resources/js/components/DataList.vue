<template>

  <div class="w-full mx-auto z-10">
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
        }
    },
    created: function () {
      this.getData();
    },
    methods: {
      async getData(page = 1) {
        const { data } = await axios.get(`${this.getUrl}?page=${page}`)
        this.laravelData = data
      }
    }    
  }

</script>