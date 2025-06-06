<script setup>
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/components/PrimaryButton.vue';
import FormInput from '@/components/FormInput.vue';
const emit = defineEmits(['close']);

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

function submit() {
  form.post('/register', {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      emit('close');
    },
  });
}

</script>

<template>
  <form @submit.prevent="submit" class="space-y-4">
    <div>
      <label class="block mb-1 font-semibold">Name</label>
      <FormInput
        v-model="form.name"
        type="text"
        placeholder="Your full name"
        required
      />
      <p v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</p>
    </div>

    <div>
      <label class="block mb-1 font-semibold">Email</label>
      <FormInput
        v-model="form.email"
        type="email"
        placeholder="you@example.com"
        required
      />
      <p v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</p>
    </div>

    <div>
      <label class="block mb-1 font-semibold">Password</label>
      <FormInput
        v-model="form.password"
        type="password"
        placeholder="Password"
        required
      />
      <p v-if="form.errors.password" class="text-red-600 text-sm mt-1">{{ form.errors.password }}</p>
    </div>

    <div>
      <label class="block mb-1 font-semibold">Confirm Password</label>
      <FormInput
        v-model="form.password_confirmation"
        type="password"
        placeholder="Confirm password"
        required
      />
      <p v-if="form.errors.password_confirmation" class="text-red-600 text-sm mt-1">{{ form.errors.password_confirmation }}</p>
    </div>

    <PrimaryButton
      type="submit"
      :disabled="form.processing"
    >
      Register
    </PrimaryButton>
  </form>
</template>
