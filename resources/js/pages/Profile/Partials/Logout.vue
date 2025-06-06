<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm()

function logout() {
  form.post(route('logout'), {
    onSuccess: () => {
    }
  })
}
</script>

<template>
  <button
    @click="logout"
    type="button"
    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded"
  >
    Log Out
  </button>
</template>
