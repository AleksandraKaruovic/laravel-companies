<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/components/PrimaryButton.vue';
import Card from '@/components/WelcomeCard.vue';
defineProps({
  
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    heading: {
    type: String,
    default: 'Welcome'
  },
  buttonLabel: {
    type: String,
    default: 'Create Job',  
  },
  buttonHref: {
    type: String,
    default: '/jobs/create', 
  },
  recentJobs: {
    type: Array,
  },
  recentCompanies: {
    type: Array,
  },
  totalJobs: {
    type: Number,
  },
  totalCompanies: {
    type: Number,
  },
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
                
              </div>
            </div>
          </div>

       
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                <span class="sr-only">View notifications</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
              </button>

              <div class="ml-3 relative">
                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                  <span class="sr-only">Open user menu</span>
                  <img class="size-8 rounded-full" src="https://cdn.dribbble.com/userupload/18122564/file/still-d551d098304672098335706a82934d3f.png?format=webp&resize=400x300&vertical=center" alt="" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ heading }}</h1>
       <PrimaryButton :href="buttonHref">{{ buttonLabel }}</PrimaryButton>
      </div>
    </header>
   </div>
</template>