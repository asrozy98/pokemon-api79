<?php

namespace App\Http\Livewire;

use App\Helpers\Helpers;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Detail extends Component
{
    public $pokemon_id;
    public $saved = false;
    public $myPokemon;
    public $namaPokemon;

    protected $listeners = ['renamePokemon'];

    public function render()
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

        $myPokemon = Pokemon::where('pokemon_id', $this->pokemon_id)->first();
        if ($myPokemon) {
            $this->saved = true;
        }
        $this->namaPokemon = $response['name'];
        $params = [
            'pokemon_id' => $this->pokemon_id,
            'name' => $response['name'],
            'image' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $this->pokemon_id . '.png',
            'images' => $image,
            'weight' => $response['weight'],
            'height' => $response['height'],
            'moves' => $moves,
            'types' => $types,
            'saved' => $this->saved,
        ];
        return view('livewire.detail', $params);
    }

    public function catchPokemon()
    {
        $ran = rand(0, 99);
        if ($ran % 2 == 0) {
            $oldPokemon = Pokemon::where('pokemon_id', $this->pokemon_id)->get();

            $pokemon = new Pokemon;
            $pokemon->pokemon_id = $this->pokemon_id;
            $pokemon->name = $this->namaPokemon . '-' . $oldPokemon->count();
            $pokemon->save();

            $this->saved = true;
            $this->dispatchBrowserEvent('swal:catch', [
                'type' => 'success',
                'message' => 'Rename your Pokemon',
                'text' => $this->namaPokemon . ' Cathed, rename your Pokemon name',
                'rename' => true,
            ]);
        } else {
            $this->dispatchBrowserEvent('swal:catch', [
                'type' => 'error',
                'message' => 'Pokemon Catch Failed!',
                'text' => 'Try again.',
                'rename' => false,
            ]);
        }
    }

    public function renamePokemon($name)
    {
        $oldPokemon = Pokemon::where('name', 'like', '%' . $name . '%')->get();

        $pokemon = Pokemon::where('pokemon_id', $this->pokemon_id)->first();
        $pokemon->name = $name . '-' . Helpers::fibonacci($oldPokemon->count() + 1);
        $pokemon->save();

        $this->dispatchBrowserEvent('swal:catch', [
            'type' => 'success',
            'message' => 'Pokemon Cathed!',
            'text' => 'It will not list on pokemon.',
            'rename' => false,
        ]);
    }

    public function releasePokemon()
    {
        $ran = rand(0, 9);
        if (Helpers::prima($ran)) {
            $pokemon = Pokemon::where('pokemon_id', $this->pokemon_id)->latest();
            $pokemon->delete();

            $this->saved = false;
            $this->dispatchBrowserEvent('swal:release', [
                'type' => 'success',
                'message' => 'Pokemon Released!',
                'text' => 'It will not list on pokemon.'
            ]);
        } else {
            $this->dispatchBrowserEvent('swal:release', [
                'type' => 'error',
                'message' => 'Pokemon Release Failed!',
                'text' => 'Try again.'
            ]);
        }
    }
}
