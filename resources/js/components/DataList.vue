<template>

  <div class="w-full mx-auto z-10">
    <!-- List Items -->
    <div v-for="(item, index) in data" :key="index">
      <div class="flex flex-col">
        <div class="bg-white hover:bg-gray-100 border border-white hover:border-gray-100 shadow-lg rounded-3xl p-4 m-4">
          <div class="flex-none sm:flex text-gray-500 leading-tight">
            {{ item.name }}
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  
  import axios from 'axios';

  export default {
    name: "DataList",
    props: {
        getUrl: {
            type: String,
            required: true
        },
    },    
    data() {
        return {   
            data: [],        
        }
    },
    created: function () {
      this.getData();
    },
    methods: {
      async getData() {
        const { data } = await axios.get(this.getUrl)
        this.data = data
      }
    }    
  }

</script>