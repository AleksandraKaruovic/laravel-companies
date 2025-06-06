<template>
  <div>
    <label :for="id" class="block text-sm font-medium text-gray-700 mb-1">{{ label }}</label>
    <select
      :id="id"
      :name="name"
      :value="modelValue"
     @change="$emit('update:modelValue', Number($event.target.value))"
      class="block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
    >
      <option disabled value="">Select a company</option>
      <option v-for="option in options" :key="option.id" :value="option.id">
        {{ option.name }}
      </option>
    </select>
    <p v-if="error" class="text-red-500 text-sm mt-1">{{ error }}</p>
  </div>
</template>

<script setup>

const props = defineProps({
  modelValue: [String, Number],
  label: String,
  name: String,
  id: String,
  options: Array,
  error: String
});

const emit = defineEmits(['update:modelValue']);

function updateValue(event) {
  emit('update:modelValue', event.target.value);
}
</script>
