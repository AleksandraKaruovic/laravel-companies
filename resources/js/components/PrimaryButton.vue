<script setup>
import { Link } from '@inertiajs/vue3'
import Button from './ui/button/Button.vue';
const props = defineProps({
  href: String, 
  type: {
    type: String,
    default: 'button'
  },
  disabled: {
    type: Boolean,
    default: false
  }
})
</script>
<template>
  <Link
    v-if="href"
    :href="href"
    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-2.5 py-1.5 rounded inline-flex items-center justify-center"
  >
    <slot />
  </Link>
  <Button
    v-else
    :type="type"
    :disabled="disabled"
    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-2.5 py-1.5 rounded"
  >
<slot/>
  </Button>
</template>
