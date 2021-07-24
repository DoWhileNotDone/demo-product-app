<template>

  <div class="w-full max-w-md">
    <form class="bg-white shadow-md rounded mt-8 px-8 pt-6 pb-8 mb-4" action="#" @submit.prevent="handleImport">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="file">
          File
        </label>
        <input data-test="file" type="file" id="file" name="file" ref="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      </div>
      <div class="flex items-center justify-between">
        <button data-test="upload" :disabled="submitted" @click="handleImport" class="bg-blue-500 hover:bg-blue-700 disabled:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
          Import
        </button>
         <p v-if="completed" class="m-2 text-red-500 text-xs italic">The file has been uploaded and has been queued for processing.</p>
      </div>
    </form>
  </div>
</template>

<script>
  
  import axios from 'axios';

  export default {
    name: "FileImporter",
    props: {
        postUrl: {
            type: String,
            required: true
        },
    },
    data() {
        return {            
            submitted: false,
            completed: false,
        }
    },
    methods: {
      async handleImport() {
        try {
          this.submitted = true
          this.completed = false

          const formData = new FormData()
          formData.append('file', this.$refs.file.files[0])
          
          await axios.post(
            this.postUrl,
            formData, 
            {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            }
          )

          this.submitted = false
          this.completed = true
        } catch (error) {
            this.submitted = false
            this.completed = false
            console.log(error)
        }
      },
    }    
  }

</script>