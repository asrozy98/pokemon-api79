<div>
    <div class="row">
        @forelse ($data as $item)
            <div class="col-2 mb-4">
                <div class="card shadow-sm">
                    <a href="{{ url('detail/' . $item->pokemon_id) }}">
                        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{ $item->pokemon_id }}.png"
                            class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h3 class="card-text">{{ $item->name }}</h3>
                        </div>
                    </a>
                    <div class="card-footer px-4">
                        <Button class="btn btn-sm btn-secondary" wire:click="rename({{ $item->id }})">Rename</Button>
                        <Button class="btn btn-sm btn-danger" wire:click="release({{ $item->id }})">Release</Button>
                    </div>
                </div>
            </div>
        @empty
            <center>
                <h3 class="card-text center">No Pokemon</h3>
            </center>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $data->links() }}
    </div>
</div>
