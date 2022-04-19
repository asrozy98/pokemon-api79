<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Home extends Component
{
    public $link = 'https://pokeapi.co/api/v2/pokemon';

    public function render()
    {
        $response = Http::get($this->link)->json();
        $data = [];
        foreach ($response['results'] as $item) {
            $temp = explode('/', trim($item['url'], '/'));
            $id = $temp[count($temp) - 1];
            $data[] = (object) [
                'id' => $id,
                'name' => $item['name'],
                'image' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/' . $id . '.png',
                'detail' => $item['url']
            ];
        }
        $params = [
            'data' => $data,
            'link' => $this->link,
            'next' => $response['next'],
            'prev' => $response['previous'],
            'count' => $response['count'],
        ];

        return view('livewire.home', $params);
    }

    public function link($link)
    {
        $this->link = $link;
    }
}
