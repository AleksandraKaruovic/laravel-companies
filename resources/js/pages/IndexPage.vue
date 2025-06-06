<script setup>
import { Link } from '@inertiajs/vue3'
import Card from '@/components/WelcomeCard.vue'
import Welcome from '@/layouts/Welcome.vue'

defineProps({
  recentJobs: Array,
  recentCompanies: Array,
  totalJobs: Number,
  totalCompanies: Number,
})
function formatDate(dateStr) {
  const options = { year: 'numeric', month: 'short', day: 'numeric' };
  return new Date(dateStr).toLocaleDateString(undefined, options);
}

</script>

<template>
   
  <Welcome heading="Welcome" buttonLabel="Create Job" buttonHref="/jobs/create">
     <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto auto-rows-fr">

      <Card title="New Jobs">
        <ul class="text-gray-700 list-none flex flex-col items-center text-center space-y-2">
          <li v-for="job in recentJobs" :key="job.id">
            <Link :href="`/jobs/${job.id}`" class="text-indigo-600 hover:underline">
              {{ job.title }} at {{ job.company?.name }} ({{ formatDate(job.created_at) }})
            </Link>
          </li>
        </ul>
      </Card>

      <Card title="New Companies" >
        <ul class="text-gray-700 list-none flex flex-col items-center text-center space-y-2">
          <li v-for="company in recentCompanies" :key="company.id">
            <Link :href="`/companies/${company.id}`" class="text-indigo-600 hover:underline">
              {{ company.name }} ({{ formatDate(company.created_at) }})
            </Link>
          </li>
        </ul>
      </Card>
      <Card title="Total Jobs">
       <div class="flex items-center justify-center" style="height: 150px;">
          <Link href="/jobs" class="text-center text-6xl font-extrabold text-indigo-700 hover:underline cursor-pointer">
             {{ totalJobs }}
          </Link>
        </div>

      </Card>
      <Card title="Total Companies">
        <div class="flex items-center justify-center" style="height: 150px;">
    <Link href="/companies" class="text-center text-6xl font-extrabold text-indigo-700 hover:underline cursor-pointer">
      {{ totalCompanies }}
    </Link>
  </div>
      </Card>
    </div>
  </Welcome>
</template>
