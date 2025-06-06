<script setup>
import { Link } from '@inertiajs/vue3'
import PaginationButton from '@/components/PaginationButton.vue'

defineProps({
  companies: Object
})
</script>
<template>
  <div class="space-y-4">
    <Link
      v-for="company in companies.data"
      :key="company.id"
      :href="`/companies/${company.id}`"
      class="block px-4 py-6 border border-gray-200 rounded-lg hover:bg-gray-50"
    >
      <div class="font-bold text-indigo-600 text-lg">{{ company.name }}</div>
      <div class="text-sm text-gray-600">
        {{ company.city }}, {{ company.country }}
      </div>
      <div class="text-gray-700 mt-2 line-clamp-2">
        {{ company.description }}
      </div>
    </Link>

    <div class="flex justify-between mt-6">
      <Link v-if="companies.prev_page_url" :href="companies.prev_page_url">
        <PaginationButton>← Previous</PaginationButton>
      </Link>
      <Link v-if="companies.next_page_url" :href="companies.next_page_url" class="ml-auto">
        <PaginationButton>Next →</PaginationButton>
      </Link>
    </div>
  </div>
</template>