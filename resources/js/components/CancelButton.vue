<script setup>
import Button from './ui/button/Button.vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  href: String
})

function handleClick() {
  if (props.href) {
    router.visit(props.href)
  }
}
</script>

<template>
  <Button
    type="button"
    @click="handleClick"
    class="text-sm font-semibold text-gray-900"
  >
    <slot />
  </Button>
</template>
