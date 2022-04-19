<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;

class PokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . $this->pokemon_id)->json();
        $image = [];
        foreach ($response["sprites"] as $item) {
            if ($item && !is_array($item)) {
                $image[] = $item;
            }
        }

        $moves = [];
        foreach ($response["moves"] as $item) {
            $moves[] = $item['move']['name'];
        }

        $types = [];
        foreach ($response["types"] as $item) {
            $types[] = $item['type']['name'];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'pokemon_id' => $this->pokemon_id,
            'name_pokemon' => $response['name'],
            'image' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $this->pokemon_id . '.png',
            'images' => $image,
            'weight' => $response['weight'],
            'height' => $response['height'],
            'moves' => $moves,
            'types' => $types,
        ];
    }
}
