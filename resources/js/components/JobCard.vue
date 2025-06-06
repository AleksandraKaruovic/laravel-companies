<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  job: Object
})
</script>
<template>
    <Link :href="route('jobs.show', job.id)" class="block px-4 py-6 border border-gray-200 rounded-lg">
          <div class="font-bold text-indigo-500 text-sm">{{ job.company.name }}</div>
          <div>
            <strong>{{ job.title }}:</strong> Pays {{ job.salary }} per month
          </div>
    </Link>
</template>