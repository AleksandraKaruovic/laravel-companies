<script setup>
const props = defineProps({
  modelValue: {
    type: [String, Number, File],
    default: ''
  },
  label: {
    type: String,
    required: true
  },
  id: {
    type: String,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  type: {
    type: String,
    default: 'text' 
  },
  placeholder: {
    type: String,
    default: ''
  },
  error: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['update:modelValue']);

function handleInput(event) {
  if (props.type === 'file') {
    emit('update:modelValue', event.target.files[0]);
  } else {
    emit('update:modelValue', event.target.value);
  }
}
</script>

<template>
  <div>
    <label :for="id" class="block text-sm font-medium text-gray-900">{{ label }}</label>

    <template v-if="type === 'textarea'">
      <textarea
        :id="id"
        :name="name"
        :placeholder="placeholder"
        :value="modelValue"
        @input="handleInput"
        class="mt-2 block w-full rounded-md border border-gray-300 px-3 py-1.5 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600"
        rows="4"
      />
    </template>

    <template v-else>
      <input
        :id="id"
        :name="name"
        :type="type"
        :placeholder="placeholder"
        :value="type === 'file' ? undefined : modelValue"
        @input="type !== 'file' && handleInput"
        @change="handleInput"
        class="mt-2 block w-full rounded-md border border-gray-300 px-3 py-1.5 text-base text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-600"
      />
    </template>

    <p v-if="error" class="text-red-500 text-sm mt-1">{{ error }}</p>
  </div>
</template>
