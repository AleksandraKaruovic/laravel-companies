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
            try {
                $response = Http::timeout(5)->get("https://pokeapi.co/api/v2/pokemon", [
                    'limit' => $limit,
                    'offset' => $offset,
                ]);
                
                // Throws exception if response status code is 4xx or 5xx
                $response->throw();

                $pokemon_data = $response->json(); //Converts the JSON response body into a PHP array

                if (!isset($pokemon_data['results'])) {
                    throw new \Exception('Unexpected API response structure.');
                }

                Cache::put($cacheKey, $pokemon_data, now()->addMinutes(60));

            } catch (RequestException $e) {

                \Log::error('Pokemon API getList error: ' . $e->getMessage()); //This logs the error message to your Laravel logs,  ($e->getMessage()) tells you what went wrong

                return [
                    'pokemonList' => [],
                    'nextPage' => null,
                    'prevPage' => null,
                ];
            } catch (\Exception $e) {
                \Log::error('Pokemon API unexpected error: ' . $e->getMessage());

                return [
                    'pokemonList' => [],
                    'nextPage' => null,
                    'prevPage' => null,
                ];
            }
        }

        return [
            'pokemonList' => $pokemon_data['results'],
            'nextPage' => !empty($pokemon_data['next']) ? $page + 1 : null,
            'prevPage' => !empty($pokemon_data['previous']) ? $page - 1 : null,
        ];
    }

    public function getById($id): array
    {
        $cacheKey = "pokemon_{$id}";

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = Http::timeout(5)->get("https://pokeapi.co/api/v2/pokemon/{$id}");
            $response->throw();

            $pokemon = $response->json();

            Cache::put($cacheKey, $pokemon, now()->addMinutes(60));

            return $pokemon;
        } catch (RequestException $e) {
            \Log::error("Pokemon API getById error for ID {$id}: " . $e->getMessage());

            // Return empty or default response
            return [];
        } catch (\Exception $e) {
            \Log::error("Pokemon API unexpected error for ID {$id}: " . $e->getMessage());

            return [];
        }
    }
}
