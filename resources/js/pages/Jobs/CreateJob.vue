<script setup>
import { useForm } from '@inertiajs/vue3'
import Welcome from '../../layouts/Welcome.vue';
import FormInput from '@/components/FormInput.vue';
import Dropdown from '@/components/Dropdown.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import CancelButton from '@/components/CancelButton.vue';

const props = defineProps({
  companies: {
    type: Array,
    required: true
  }
})

const form = useForm({
  title: '',
  salary: '',
  company_id: '',
})

function submit() {
  form.company_id = parseInt(form.company_id);
  form.post('/jobs');
}
</script>

<template>
    <Welcome heading="Create job">
    <div class="max-w-md mx-auto">
  <form @submit.prevent="submit" class="space-y-8">
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
    </div>

    <div class="flex justify-end gap-x-6">
      <CancelButton href="/jobs">Cancel</CancelButton>
      <PrimaryButton type="submit">
        Save
      </PrimaryButton>
    </div>
  </form>
    </div>
  </Welcome>
</template>