<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import md5 from 'crypto-js/md5'


const user = usePage().props.auth.user;
const fileInput = ref(null);
const gravatarUrl = `https://www.gravatar.com/avatar/${md5(user.email.trim().toLowerCase()).toString()}?s=160&d=identicon`
const avatarPreview = ref(user.avatar_url|| gravatarUrl);

function triggerFileInput() {
  fileInput.value?.click();
}

function onFileChange(event) {
  const file = event.target.files[0];
  if (!file) return;

  avatarPreview.value = URL.createObjectURL(file);

  const formData = new FormData();
  formData.append('avatar', file);

  router.post('/user/avatar', formData, {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      confirm('Avatar updated successfully!');
      router.reload({ only: ['auth'] });
    },
    onError: (errors) => {
      console.error('Upload failed:', errors);
    }
  });
}
</script>

<template>
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow flex items-center space-x-6">
        <div @click="triggerFileInput" class="cursor-pointer relative w-20 h-20 rounded-full overflow-hidden">
          <img
            :src="avatarPreview"
            alt="User Avatar"
            class="w-20 h-20 object-cover"
            title="Click to change avatar"
          />
          <div
            class="absolute inset-0 bg-black bg-opacity-25 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity text-white font-semibold"
          >
            Change
          </div>
        </div>

        <input
          ref="fileInput"
          type="file"
          accept="image/*"
          class="hidden"
          @change="onFileChange"
        />

        <div>
          <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ user.name }}</h3>
          <p class="text-gray-600 dark:text-gray-300">{{ user.email }}</p>
        </div>
      </div>
</template>