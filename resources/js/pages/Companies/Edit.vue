<script setup>
import { useForm } from '@inertiajs/vue3';
import Welcome from '@/layouts/Welcome.vue';
import FormInput from '@/components/FormInput.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import CancelButton from '@/components/CancelButton.vue';
import DeleteButton from '@/components/DeleteButton.vue';

const props = defineProps({
  company: Object,
});

const form = useForm({
  name: props.company.name,
  description: props.company.description,
  address: props.company.address,
  city: props.company.city,
  country: props.company.country,
  phone: props.company.phone,
  logo: null, 
});
 
function submit() {
  console.log('Submitting form:', form.name);
  form.put(`/companies/${props.company.id}`, {
    forceFormData: true,
  });
}
function deleteCompany() {
  if (confirm('Are you sure you want to delete this company?')) {
    form.delete(`/companies/${props.company.id}`);
  }
}
</script>

<template>
  <Welcome :heading="`Edit Company: ${form.name}`">
    <form @submit.prevent="submit" class="space-y-8 max-w-2xl">
      <div class="space-y-12 border-b border-gray-900/10 pb-12">
        <FormInput
          id="name"
          name="name"
          label="Name"
          placeholder="Example Corp"
          v-model="form.name"
          :error="form.errors.name"
        />

        <FormInput
          id="description"
          name="description"
          label="Description"
          placeholder="Brief company description"
          v-model="form.description"
          :error="form.errors.description"
        />

        <FormInput
          id="address"
          name="address"
          label="Address"
          placeholder="123 Main St"
          v-model="form.address"
          :error="form.errors.address"
        />

        <FormInput
          id="city"
          name="city"
          label="City"
          placeholder="Belgrade"
          v-model="form.city"
          :error="form.errors.city"
        />

        <FormInput
          id="country"
          name="country"
          label="Country"
          placeholder="Serbia"
          v-model="form.country"
          :error="form.errors.country"
        />

        <FormInput
          id="phone"
          name="phone"
          label="Phone"
          placeholder="+381 60 1234567"
          v-model="form.phone"
          :error="form.errors.phone"
        />
        <FormInput
          id="logo"
          name="logo"
          label="Company Logo"
          type="file"
          :error="form.errors.logo"
          @update:modelValue="form.logo = $event"
            />

        <div class="mt-6 flex items-center justify-between gap-x-6">
        <DeleteButton @click="deleteCompany" >Delete</DeleteButton>
          <div class="flex gap-4">
            <CancelButton :href="`/companies/${props.company.id}`">Cancel</CancelButton>
            <PrimaryButton type="submit">Update</PrimaryButton>
          </div>
        </div>
      </div>
    </form>
  </Welcome>
</template>
