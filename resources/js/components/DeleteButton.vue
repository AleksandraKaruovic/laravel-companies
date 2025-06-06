<script setup>
import Button from './ui/button/Button.vue';
import { useForm } from '@inertiajs/vue3'
const props = defineProps({
  job: Object,
})
const form = useForm()


</script>
<template>
  <Button type="button" class="text-red-500 text-sm font-bold">
    <slot />
</Button>
</template>