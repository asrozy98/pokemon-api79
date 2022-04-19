<?php

namespace App\Http\Repository;

use App\Helpers\Helpers;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Http;

class PokemonRepository
{
    public static function get()
    {
        $pokemon = Pokemon::get();

        return $pokemon;
    }

    public static function create($request)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . $request->pokemon_id)->json();
        $oldPokemon = Pokemon::where('pokemon_id', $request->pokemon_id)->get();

        $pokemon = new Pokemon;
        $pokemon->pokemon_id = $request->pokemon_id;
        $pokemon->name = $response['name'] . '-' . Helpers::fibonacci($oldPokemon->count() + 1);
        $pokemon->save();

        return $pokemon;
    }

    public static function delete($request)
    {
        $data = Pokemon::where('pokemon_id', $request->pokemon_id)->first();
        if ($data) {
            $data->delete();

            return true;
        }
        return false;
    }

    public static function update($request)
    {
        $oldPokemon = Pokemon::where('name', 'like', '%' . $request->name . '%')->get();

        $pokemon = Pokemon::where('pokemon_id', $request->pokemon_id)->first();
        $pokemon->name = $request->name . '-' . Helpers::fibonacci($oldPokemon->count() + 1);
        $pokemon->save();

        return $pokemon;
    }
}
