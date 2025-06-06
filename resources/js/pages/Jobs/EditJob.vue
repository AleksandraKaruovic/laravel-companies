<script setup>
import { useForm } from '@inertiajs/vue3'
import Dropdown from '@/components/Dropdown.vue';
import Welcome from '../../layouts/Welcome.vue';
import FormInput from '@/components/FormInput.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import CancelButton from '@/components/CancelButton.vue';
import DeleteButton from '@/components/DeleteButton.vue';
const props = defineProps({
  job: Object,
  companies: Array,
});

const form = useForm({
  title: props.job.title,
  salary: props.job.salary,
  company_id: props.job.company_id,
});
 
function submit() {
  form.patch(`/jobs/${props.job.id}`);
}

function deleteJob() {
  if (confirm('Are you sure you want to delete this job?')) {
    form.delete(`/jobs/${props.job.id}`)
  }
}


</script>
<template>
  <Welcome :heading="`Edit job: ${form.title}`">
    <form @submit.prevent="submit" class="space-y-8 max-w-2xl">
      <div class="space-y-12 border-b border-gray-900/10 pb-12">
      <FormInput
          id="title"
          name="title"
          label="Title"
          placeholder="Shift Leader"
          v-model="form.title"
          :error="form.errors.title"
        />

        <FormInput
          id="salary"
          name="salary"
          label="Salary"
          placeholder="$5000"
          v-model="form.salary"
          :error="form.errors.salary"
        />

        <Dropdown
        id="company"
        name="company_id"
        label="Company"
        v-model="form.company_id"
        :options="props.companies"
        :error="form.errors.company_id"
      />

          <div class="mt-6 flex items-center justify-between gap-x-6">
            <DeleteButton @click="deleteJob" >Delete</DeleteButton>
            <div class="flex gap-4">
              <CancelButton :href="`/jobs/${job.id}`">Cancel</CancelButton>
              <PrimaryButton type="submit">Update</PrimaryButton>
            </div>
          </div>
      </div>
    </form>
  </Welcome>
</template>