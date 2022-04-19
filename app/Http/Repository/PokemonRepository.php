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
        $name = $request->name != null ? $request->name : $response['name'];

        $pokemon = new Pokemon;
        $pokemon->pokemon_id = $request->pokemon_id;
        $pokemon->fibonacci = 0;
        $pokemon->name = $name;
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
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . $request->pokemon_id)->json();

        $pokemon = Pokemon::where('pokemon_id', $request->pokemon_id)->first();
        $name = explode('-', $pokemon->name);
        $pokemon->fibonacci = $pokemon->fibonacci + 1;
        $pokemon->name = $pokemon->fibonacci >= 1 ? $name[0] . '-' . Helpers::fibonacci($pokemon->fibonacci) : $name[0];
        $pokemon->save();

        return $pokemon;
    }
}
