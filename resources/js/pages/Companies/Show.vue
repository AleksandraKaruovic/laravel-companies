<script setup>
import { Link } from '@inertiajs/vue3';
import Welcome from '@/layouts/Welcome.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import CompanyComments from './Partials/CompanyComments.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  company: Object,
  jobs: Array,
  comments: Array,
  authUserId: Number,
  isInterested: Boolean,
  interestedCount: Number
});

const interested = ref(props.isInterested);

function toggleInterest(companyId) {
  router.post(`/companies/${companyId}/toggle-interest`, {}, {
    preserveScroll: true,
    onSuccess: () => {
      interested.value = !interested.value;
    }
  });
}
</script>

<template>
  <Welcome :heading="`Company: ${props.company.name}`">
    <div class="space-y-4">
      <h2 class="font-bold text-lg">{{ props.company.name }}</h2>

      <div v-if="props.company.logo" class="mb-4">
        <img
          :src="props.company.logo"
          alt="Company Logo"
          class="max-w-xs max-h-48 object-contain"
        />
      </div>
      
      <p>{{ props.company.description }}</p>
      <p>Location: {{ props.company.address }}</p>
      <p>Phone: {{ props.company.phone }}</p>

      <h3 class="mt-6 font-semibold">Jobs at this company:</h3>
      <ul class="list-disc pl-5">
        <li v-for="job in props.jobs" :key="job.id">
          <Link :href="`/jobs/${job.id}`" class="text-indigo-600 hover:underline">{{ job.title }}</Link>
        </li>
      </ul>

      <div class="mt-6 flex items-center space-x-4">
      <PrimaryButton :href="`/companies/${props.company.id}/edit`">
        Edit Company
      </PrimaryButton>

      <PrimaryButton
        @click="toggleInterest(props.company.id)"
      >
        {{ interested ? 'Remove from interests' : 'I am interested' }}
      </PrimaryButton>
    </div>

    <p v-if="interested" class="mt-2 text-green-600">You are interested in this company</p>
    <p class="mt-2 text-sm text-gray-600">
    {{ props.interestedCount }} user{{ props.interestedCount === 1 ? '' : 's' }} interested in this company.
    </p>
      <CompanyComments
      :company-id="props.company.id"
      :comments="props.comments"
      :auth-user-id="props.authUserId"
    />
    </div>
  </Welcome>
</template>
