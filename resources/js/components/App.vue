<template>
    <div>
      <div class="flex items-center justify-center">
        <file-importer post-url="/api/products"></file-importer>  
      </div>
      <data-list get-url="/api/products"></data-list>  
    </div>
</template>

<script>

  import DataList from './DataList.vue'
  import FileImporter from './FileImporter.vue'
  
  export default {
    name: "App",
    components: {
      DataList,
      FileImporter, 
    },
  }
</script>
