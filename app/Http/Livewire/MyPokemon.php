<?php

namespace App\Http\Livewire;

use App\Helpers\Helpers;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class MyPokemon extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['rename', 'release'];
    public function render()
    {
        $params = [
            'data' => Pokemon::orderBy('name', 'asc')->paginate(12),
        ];

        return view('livewire.my-pokemon', $params);
    }

    public function rename($id)
    {
        $pokemon = Pokemon::find($id);
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . $pokemon->pokemon_id)->json();
        $namePokemon = explode('-', $pokemon->name);

        $pokemon->fibonacci = $pokemon->fibonacci + 1;
        $pokemon->name = $pokemon->fibonacci >= 1 ? $namePokemon[0] . '-' . Helpers::fibonacci($pokemon->fibonacci) : $namePokemon[0];
        $pokemon->save();
    }

    public function release($id)
    {
        $ran = rand(0, 9);
        if (Helpers::prima($ran)) {
            $pokemon = Pokemon::find($id);
            $pokemon->delete();

            $this->dispatchBrowserEvent('swal:release', [
                'type' => 'success',
                'message' => 'Pokemon released!',
            ]);
        } else {
            $this->dispatchBrowserEvent('swal:release', [
                'type' => 'error',
                'message' => 'Pokemon release failed!',
            ]);
        }
    }
}
