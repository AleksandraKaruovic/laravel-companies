<script setup>
import { usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user
</script>

<template>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow-lg">
    <h1 class="text-3xl font-bold mb-4">User Profile</h1>
    <div class="flex items-center space-x-4">
      <img :src="user.avatar_url" alt="User avatar" class="w-16 h-16 rounded-full" />
      <div>
        <p class="text-xl font-semibold">{{ user.name }}</p>
        <p class="text-gray-600">{{ user.email }}</p>
      </div>
    </div>
  </div>
</template>
