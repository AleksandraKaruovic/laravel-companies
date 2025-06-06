<script setup>
import Welcome from '@/layouts/Welcome.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { usePage } from '@inertiajs/vue3'
import { ref } from 'vue';
import Logout from './Partials/Logout.vue';
import UserImg from './Partials/UserImg.vue';

const showDelete = ref(false);
const user = usePage().props.auth.user

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Welcome heading="Profile">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Profile
            </h2>
        </template>

        <div class="py-12 max-w-3xl mx-auto space-y-6 sm:px-6 lg:px-8">
          
            
                <UserImg />

           
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>

            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                <Logout></Logout>
        <button
            @click="showDelete = true"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition ml-8"
        >
            Delete Account
        </button>

        <DeleteUserForm v-if="showDelete" @close="showDelete = false" />
        
        </div>
        
        </div>
    </Welcome>
</template>

