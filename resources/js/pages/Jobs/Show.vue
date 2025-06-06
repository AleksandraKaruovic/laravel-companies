<script setup>
import PrimaryButton from '@/components/PrimaryButton.vue';
import Welcome from '@/layouts/Welcome.vue'
import { Link } from '@inertiajs/vue3';


defineProps({
  job: Object
})
</script>

<template>
    <Welcome heading="Job Details">
        <div class="space-y-4">
            <h2 class="font-bold text-lg">{{ job.title }}</h2>
    <p>
    This job payes {{ job.salary }} per month.
    </p>
    <p>
  Company:
  <Link :href="`/companies/${job.company.id}`" class="text-indigo-600 hover:underline">
    <strong>{{ job.company.name }}</strong>
  </Link>
</p>

    <p class="mt-6">
        <PrimaryButton :href="`/jobs/${job.id}/edit`">Edit Job</PrimaryButton>
    </p>
    </div>
    </Welcome>
</template>