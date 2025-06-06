<script setup>
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/components/PrimaryButton.vue';
import FormInput from '@/components/FormInput.vue';
import { router } from '@inertiajs/vue3';

const emit = defineEmits(['close', 'open-register']);

const form = useForm({
  email: '',
  password: '',
});

function submit() {
  form.post('/login', {
    onSuccess: () => {
      emit('close');
      router.visit('/dashboard');
    },
    onError: () => {
     
    },
  });
}
</script>

<template>
  <form @submit.prevent="submit" class="space-y-4">
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

    <PrimaryButton type="submit" :disabled="form.processing">Login</PrimaryButton>
     <button
        type="button"
        @click="$emit('open-register')"
        class="text-sm text-indigo-600 hover:underline ml-20"
      >
        New user? Register here
      </button>

  </form>
</template>
