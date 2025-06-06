<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { usePage } from '@inertiajs/vue3';
import RegisterForm from '@/pages/Profile/Partials/RegisterForm.vue';
import Modal from '@/components/Modal.vue'; 
import LoginForm from '@/pages/Profile/Partials/LoginForm.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import md5 from 'crypto-js/md5';

function navigateTo(url) {
  router.visit(url);
}
const page = usePage();
const user = page.props.auth.user;

const showRegisterModal = ref(false);

function openRegisterModal() {
  showRegisterModal.value = true;
}
function closeRegisterModal() {
  showRegisterModal.value = false;
}
const showLoginModal = ref(false); 
function openLoginModal() {
  showLoginModal.value = true;
}
function closeLoginModal() {
  showLoginModal.value = false;
}
function goToSavedCompanies() {
  if (user) {
  router.get('/interests'); 
  } else {
    openLoginModal();
  }
}

defineProps({
  laravelVersion: { type: String, required: true },
  phpVersion: { type: String, required: true },
  heading: { type: String, default: 'Welcome' },
  buttonLabel: { type: String, default: 'Create Job' },
  buttonHref: { type: String, default: '/jobs/create' },
  recentJobs: { type: Array },
  recentCompanies: { type: Array },
  totalJobs: { type: Number },
  totalCompanies: { type: Number },
});

</script>

<template>
  <Head title="Home page" />
  <div class="min-h-full">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="shrink-0">
              <img
                class="size-8"
                src="https://cdn.dribbble.com/userupload/18122564/file/still-d551d098304672098335706a82934d3f.png?format=webp&resize=400x300&vertical=center"
                alt="Your Company"
              />
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <Link href="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</Link>
                <Link href="/jobs" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Jobs</Link>
                <Link href="/companies" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Companies</Link>
                <Link href="/contact" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</Link>
                <Link href="/pokemon" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Pokemon</Link>
              </div>
            </div>
          </div>

          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">

              <button
                type="button"
                @click="goToSavedCompanies"
                class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-red-500"
                aria-label="View saved companies"
              >
                <svg
                  class="size-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.172 5.172a4 4 0 015.656 0L12 8.343l3.172-3.171a4 4 0 115.656 5.656L12 21.343l-8.828-8.829a4 4 0 010-5.656z"
                  />
                </svg>
              </button>

              <button
                type="button"
                class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                aria-label="View notifications"
              >
                <svg
                  class="size-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                  />
                </svg>
              </button>

              <div class="ml-3 relative flex items-center space-x-4">
                <template v-if="user">
                  <Link
                    href="/profile"
                    class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                  >
                    <span class="sr-only">Open user menu</span>
                    <img
                      class="w-8 h-8 rounded-full"
                      :src="user.avatar_url || `https://www.gravatar.com/avatar/${md5(user.email.trim().toLowerCase()).toString()}?s=160&d=identicon`"
                      alt="User avatar"
                    />

                  </Link>
                </template>
                <template v-else>
                  <button
                      @click="openLoginModal"
                      class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium bg-transparent border-none cursor-pointer"
                    >
                      Login
                    </button>
                  <button
                    @click="openRegisterModal"
                    class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium bg-transparent border-none cursor-pointer"
                  >
                    Register
                  </button>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <header class="bg-white shadow-sm">
      <div
        class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between"
      >
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ heading }}</h1>
        <PrimaryButton  @click="user ? navigateTo(buttonHref) : openLoginModal()"
        class="cursor-pointer" >{{ buttonLabel }}</PrimaryButton>
      </div>
    </header>

    <main class="pt-14">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>

    
    <Modal v-if="showLoginModal" @close="closeLoginModal">
  <LoginForm
    @close="closeLoginModal"
    @open-register="() => { closeLoginModal(); openRegisterModal(); }"
  />
</Modal>
<Modal v-if="showRegisterModal" @close="closeRegisterModal">
  <RegisterForm @close="closeRegisterModal" />
</Modal>


  </div>
</template>
