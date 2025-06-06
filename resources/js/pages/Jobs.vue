<script setup>
import Welcome from '../layouts/Welcome.vue'
import JobList from '@/components/JobList.vue'


defineProps({
  jobs: Object
})
</script>

<template>
  <Welcome heading="Jobs Listing">
    <JobList :jobs="jobs" />
  </Welcome>
</template>
