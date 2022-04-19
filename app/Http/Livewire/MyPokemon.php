<?php

namespace App\Http\Livewire;

use App\Helpers\Helpers;
use App\Models\Pokemon;
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

    public function rename($id, $name = null)
    {
        $pokemon = Pokemon::find($id);

        if ($name == null) {
            $this->dispatchBrowserEvent('swal:rename', [
                'message' => 'Rename Pokemon name!',
                'text' => 'It will change pokemon name.',
                'id' => $id,
            ]);
        } else {
            $oldPokemon = Pokemon::where('name', 'like', '%' . $name . '%')->get();

            $pokemon->name = $name . '-' . Helpers::fibonacci($oldPokemon->count() + 1);
            $pokemon->save();

            $this->dispatchBrowserEvent('swal:rename', [
                'type' => 'success',
                'message' => 'Pokemon name saved!',
            ]);
        }
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
