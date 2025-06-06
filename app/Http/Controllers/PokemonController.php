<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\PokemonService;

class PokemonController extends Controller
{

    public function index(Request $request, PokemonService $pokemon_service)
    {
    $page = $request->query('page', 1);
    $pokemon_data = $pokemon_service->getList($page);

    return Inertia::render('Pokemon/Pokemon', $pokemon_data);
    }

    public function show($id, PokemonService $pokemon_service)
    {
    $pokemon = $pokemon_service->getById($id);

    return Inertia::render('Pokemon/Show', ['pokemon' => $pokemon]);
    }
}