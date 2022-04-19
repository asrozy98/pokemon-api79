<div>
    <div class="row">
        @foreach ($data as $item)
            <div class="col-3 mb-4">
                <div class="card shadow-sm">
                    <a href="{{ url('detail/' . $item->id) }}">
                        <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h3 class="card-text">{{ $item->name }}</h3>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-evenly mt-4">
        @isset($prev)
            <div class="col-2">
                <button class="btn btn-secondary float-end"
                    wire:click="link('{{ $prev == null ? 'https://pokeapi.co/api/v2/pokemon' : $prev }}')">Previous</button>
            </div>
        @endisset
        @isset($next)
            <div class="col-2">
                <button class="btn btn-primary d-inline" wire:click="link('{{ $next }}')">Next</button>
            </div>
        @endisset
    </div>
</div>
