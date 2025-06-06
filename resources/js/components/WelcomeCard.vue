<script setup>
defineProps({
  title: String,
  content: String,
});
</script>

<template>
  <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-2xl">
    <h2 class="text-xl font-bold mb-2 text-gray-800">{{ title }}</h2>
    <slot />
  </div>
</template>
 