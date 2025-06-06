<script setup>
import { useForm } from '@inertiajs/vue3'
import Welcome from '../../layouts/Welcome.vue';
import FormInput from '@/components/FormInput.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import CancelButton from '@/components/CancelButton.vue';

const form = useForm({
  name: '',
  description: '',
  address: '',
  city: '', 
  country: '',
  phone: '',
  logo: null,
})

function submit() {
  form.post('/companies', {
    forceFormData: true,
  });
}
</script>

<template>
  <Welcome heading="Create company">
    <div class="max-w-md mx-auto">
      <form @submit.prevent="submit" class="space-y-8">
        <div class="space-y-12 border-b border-gray-900/10 pb-12">
          <FormInput
            id="name"
            name="name"
            label="Name"
            placeholder="Acme Inc."
            v-model="form.name"
            :error="form.errors.name"
          />

          <FormInput
            id="description"
            name="description"
            label="Description"
            placeholder="What does your company do?"
            v-model="form.description"
            :error="form.errors.description"
            type="textarea"
          />

          <FormInput
            id="address"
            name="address"
            label="Address"
            placeholder="123 Main Street"
            v-model="form.address"
            :error="form.errors.address"
          />

          <FormInput
            id="city"
            name="city"
            label="City"
            placeholder="New York"
            v-model="form.city"
            :error="form.errors.city"
          />

          <FormInput
            id="country"
            name="country"
            label="Country"
            placeholder="USA"
            v-model="form.country"
            :error="form.errors.country"
          />

          <FormInput
            id="phone"
            name="phone"
            label="Phone"
            placeholder="+1 555 123 456"
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
        </div>

        <div class="flex justify-end gap-x-6">
          <CancelButton href="/companies">Cancel</CancelButton>
          <PrimaryButton type="submit">Save</PrimaryButton>
        </div>
      </form>
    </div>
  </Welcome>
</template>
