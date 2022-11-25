<template>
  <div class="w-full md:max-w-5xl">
    <div class="flex mb-10">
      <h1 class="flex-grow text-3xl font-bold">Weights</h1>
      <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" @click="isShowModal=true">
        Add Weight
      </button>
    </div>
    <div v-if="weights.length > 0">
      <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="py-3 px-6">Date</th>
                    <th scope="col" class="py-3 px-6">Weight</th>
                    <th scope="col" class="py-3 px-6">Comment</th>
                    <th scope="col" class="py-3 px-6"><span class="sr-only">Edit</span></th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="weight in weights" :key="weight.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                      <td class="py-4 px-6">
                        {{weight.weight_date}}
                      </td>
                      <td class="py-4 px-6">
                        {{weight.weight}}
                      </td>
                      <td class="py-4 px-6">
                        {{weight.comment}}
                      </td>
                      <td class="py-4 px-6 text-right">
                          <a href="#"  @click.prevent="editClick(weight)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                          <a href="#" @click.prevent="deleteWeight(weight.id)" class="ml-4 font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</a>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
    </div>
    <div v-else class="">
      No records found.
    </div>
    
    <!-- Weight Modal -->
    <Modal size="md" v-if="isShowModal">
      <template #header>
        <div class="flex justify-between">
          <h1 class="flex items-center text-lg">
            New Weight
          </h1>
          <div>
            <button @click="isShowModal=false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
          </div>
        </div>
      </template>
      <template #body>
        <form @submit.prevent="submitWeight" class="w-full flex flex-wrap">
          <div class="w-full mb-6">
            <Input v-model="formWeight.weight_date" type="date" name="weight_date" placeholder="Date" label="Date" />
            <div v-if="formWeight.errors.has('weight_date')" v-html="formWeight.errors.get('weight_date')" class="text-red-500" />
          </div>
          <div class="w-full mb-6">
            <Input v-model="formWeight.weight" type="number" min="0" step="0.1" name="weight" placeholder="Weight" label="Weight" />
            <div v-if="formWeight.errors.has('weight')" v-html="formWeight.errors.get('weight')" class="text-red-500" />
          </div>
          <div class="w-full mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Comment</label>
            <textarea v-model="formWeight.comment" name="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
            <div v-if="formWeight.errors.has('comment')" v-html="formWeight.errors.get('comment')" class="text-red-500" />
          </div>
          <div class="w-full">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :disabled="formWeight.busy">
              Save
            </button>
          </div>
        </form>
      </template>
    </Modal>
    
  </div>
</template>

<script>
import axios from "axios";
import { Modal, Table, Input } from 'flowbite-vue'
import Form from "vform";

export default {
  name: 'Home',

  components: { Modal, Table, Input },

  data: () => ({
    weightEndpoint: "/api/weight",
    weights: [],
    isShowModal: false,
    isAdding: true,
    formWeight: new Form({
      weight_id: null,
      weight_date: null,
      weight: null,
      comment: null,
    }),
  }),

  mounted () {
    this.loadWeights()
  },

  computed: {},

  methods: {
    loadWeights(){
      axios.get(this.weightEndpoint).then(({data}) => {
        this.weights = data.data
      })
    },
    submitWeight(){
      let apiUrl = this.weightEndpoint+'/create'
      if(!this.isAdding){
        apiUrl = this.weightEndpoint+'/update'
      }
      this.addUpdateWeight(apiUrl)
    },
    addUpdateWeight(apiUrl){
      this.formWeight.post(apiUrl).then(({data}) => {
        this.resetform()
        this.loadWeights()
      })
    },
    editClick(weight){
      this.isAdding = false
      this.formWeight.weight_id = weight.id
      this.formWeight.weight_date = weight.weight_date
      this.formWeight.weight = weight.weight
      this.formWeight.comment = weight.comment
      this.isShowModal = true
    },
    deleteWeight(id){
      if (confirm("Are you sure want to delete ?") == true) {
        axios.delete(this.weightEndpoint+'/delete/'+id).then(({data}) => {
          this.loadWeights()
          this.isShowModal = false
        })
      }
    },
    resetform(){
      this.formWeight.reset()
      this.isAdding = true
      this.formWeight.weight_id = null
      this.isShowModal = false
    }
  }
}
</script>