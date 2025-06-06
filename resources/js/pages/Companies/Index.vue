<script setup>
import { ref, watch } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import Welcome from '@/layouts/Welcome.vue'
import CompaniesList from '@/components/CompaniesList.vue'

const props = defineProps({
  companies: Object,
  onlySaved: Boolean,
})

const page = usePage()
const user = page.props.auth?.user

const onlySaved = ref(props.onlySaved || false) //onlySaved is a reactive variable (a Vue ref) initialized with the prop props.onlySaved if it exists; otherwise, it defaults to false
const showAlert = ref(false) //used to control showing an alert message to the user 

function toggleSavedFilter() {
  if (onlySaved.value && !user) {
    showAlert.value = true
    onlySaved.value = false
    return
  }

  router.get('/companies', { onlySaved: onlySaved.value ? '1' : '0' }, {
  preserveScroll: true,
})
}
watch(() => props.onlySaved, (newVal) => {
  onlySaved.value = newVal
})
</script>

<template>
  <Welcome
    heading="Companies Listing"
    buttonLabel="Create Company"
    buttonHref="/companies/create"
  >
    <div class="mb-4">
      <label class="inline-flex items-center">
        <input
          type="checkbox"
          v-model="onlySaved"
          @change="toggleSavedFilter"
          class="form-checkbox rounded text-indigo-600"
        />
        <span class="ml-2 text-sm text-gray-700">Show only saved companies</span>
      </label>
    </div>

    <div
      v-if="showAlert"
      class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded"
    >
      You need to be logged in to view saved companies.
    </div>

    <CompaniesList :companies="companies" />
  </Welcome>
</template>
