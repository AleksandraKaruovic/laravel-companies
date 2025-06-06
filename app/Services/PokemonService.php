<?php

namespace App\Services;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PokemonService
{
    public function getList(int $page = 1, int $limit = 15): array
    {
        $offset = ($page - 1) * $limit;
        $cacheKey = "pokemon_list_page_{$page}";

        if (Cache::has($cacheKey)) {
            $pokemon_data = Cache::get($cacheKey);
        } else {
            $response = Http::get("https://pokeapi.co/api/v2/pokemon?limit={$limit}&offset={$offset}");
            $pokemon_data = $response->json();
            Cache::put($cacheKey, $pokemon_data, now()->addMinutes(60));
        }

        return [
            'pokemonList' => $pokemon_data['results'],
            'nextPage' => $pokemon_data['next'] ? $page + 1 : null,
            'prevPage' => $pokemon_data['previous'] ? $page - 1 : null,
        ];
    }

    public function getById($id): array
    {
        $cacheKey = "pokemon_{$id}";

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        } else {
            $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");
            $pokemon = $response->json();
            Cache::put($cacheKey, $pokemon, now()->addMinutes(60));
            return $pokemon;
        }
    }
}
