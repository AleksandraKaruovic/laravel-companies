
<script setup>
import Welcome from '@/layouts/Welcome.vue';

defineProps({
  pokemon: Object
})
</script>
<template>
    <Welcome heading="Pokémon Details">
  <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl overflow-hidden p-6 mt-8">
    <h2 class="text-2xl font-bold mb-2 capitalize">{{ pokemon.name }}</h2>
    <img :src="pokemon.sprites.front_default" :alt="pokemon.name" class="w-32 mx-auto mb-4" />
    
    <p><strong>Base Experience:</strong> {{ pokemon.base_experience }}</p>
    <p><strong>Height:</strong> {{ pokemon.height }}</p>
    <p><strong>Weight:</strong> {{ pokemon.weight }}</p>
    
    <div class="mt-4">
      <h3 class="font-semibold">Abilities:</h3>
      <ul class="list-disc list-inside">
        <li v-for="(ability, index) in pokemon.abilities" :key="index">
          {{ ability.ability.name }} <span v-if="ability.is_hidden">(Hidden)</span>
        </li>
      </ul>
    </div>
  </div>
    </Welcome>
</template>

