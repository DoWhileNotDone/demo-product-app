<template>

  <div class="px-10 py-2">
    <div class="transition duration-500 ease-in-out rounded bg-white hover:bg-gray-100 transform hover:-translate-y-1 hover:scale-105 w-full hover:no-underline lg:max-w-full lg:flex shadow" >
      <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover text-center overflow-hidden" :style="`background-image: url('${item.image_url}')`" :title="`Image of ${item.name}`"></div>
      <div class="p-4 flex flex-col justify-between leading-normal">
        <div class="mb-8">
          <div class="text-gray-900 font-bold text-xl mb-2">{{ item.name }}</div>
          <div class="text-sm">
            <p class="pt-1 text-gray-900 leading-none">{{ item.brand }}</p>
            <p class="pt-1 text-gray-900 leading-none">{{ (item.price).toLocaleString('en-GB', {style: 'currency', currency: 'GBP' }) }}</p>
            <p class="pt-1 text-gray-600">{{ new Date(item.date_added).toLocaleString('en-GB') }}</p>
          </div>              
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  
  export default {
    name: "CardItem",
    props: {
      item: {
        type: Object,
        required: true
      }
    }, 
  }

</script>