<script setup>
import PaginationButton from '@/components/PaginationButton.vue';
import { router } from '@inertiajs/vue3';
import Welcome from '@/layouts/Welcome.vue';
import { Link } from '@inertiajs/vue3';
defineProps({
  pokemonList: Array,
  nextPage: Number,
  prevPage: Number,
});

function goToPokemonDetail(pokemon) {
  const id = pokemon.url.split('/').filter(Boolean).pop();
  router.visit(`/pokemon/${id}`);
}
</script>

<template>
  <Welcome heading="Pokémon List">
    <div class="max-w-4xl mx-auto py-10">
      <div v-if="isLoading">Loading...</div>
      <ul v-else class="space-y-2">
        <li
          v-for="pokemon in pokemonList"
          :key="pokemon.name"
          class="p-4 bg-white shadow rounded cursor-pointer hover:bg-gray-100"
          @click="goToPokemonDetail(pokemon)"
        >
          {{ pokemon.name }}
        </li>
      </ul>
        <div class="flex justify-between mt-6">
        <Link v-if="prevPage" :href="`/pokemon?page=${prevPage}`">
          <PaginationButton class="px-4 py-2 bg-gray-300 rounded">← Previous</PaginationButton>
        </Link>
        <Link v-if="nextPage" :href="`/pokemon?page=${nextPage}`" class="ml-auto">
          <PaginationButton class="px-4 py-2 bg-gray-300 rounded">Next →</PaginationButton>
        </Link>
      </div>
    </div>
  </Welcome>
</template>
