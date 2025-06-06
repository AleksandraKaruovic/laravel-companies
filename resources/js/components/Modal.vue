<script setup>
const emit = defineEmits(['close']);

function onOverlayClick(event) {

  if (event.target === event.currentTarget) {
    emit('close');
  }
}
</script>

<template>
  <div
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    @click="onOverlayClick"
  >
    <div class="bg-white rounded-lg p-6 max-w-md w-full relative">
      <button
        @click="$emit('close')"
        class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-2xl font-bold"
        aria-label="Close modal"
      >
        &times;
      </button>
      <slot />
    </div>
  </div>
</template>

