<script setup>
import Welcome from '@/layouts/Welcome.vue';
import CompanyList from '@/components/CompaniesList.vue';

const props = defineProps({
  companies: Object,
})
</script>
<template>
    <Welcome :heading="'Saved Companies'">
  <CompanyList :companies="companies" />

    <div v-if="!companies.data.length" class="text-gray-500 mt-4">
      No saved companies found.
    </div>
  </Welcome>
</template>


