<script setup>
import JobCard from './JobCard.vue'
import PaginationButton from '@/components/PaginationButton.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  jobs: Object
})
</script>

<template>
    <div class="space-y-4">
       <JobCard
      v-for="job in jobs.data"
      :key="job.id"
      :job="job"
    />

      <div class="flex justify-between mt-6">
         <Link v-if="jobs.prev_page_url" :href="jobs.prev_page_url">
          <PaginationButton>← Previous</PaginationButton>
        </Link>
        <Link v-if="jobs.next_page_url" :href="jobs.next_page_url" class="ml-auto">
          <PaginationButton>Next →</PaginationButton>
        </Link>
      </div>
      
    </div>
</template>