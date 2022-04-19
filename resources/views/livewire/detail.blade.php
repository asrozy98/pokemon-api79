<div>
    <div class="row justify-content-evenly">
        <h2>{{ $name }}</h2>
        <div class="col-md-3 justify-content-md-center">
            <img src="{{ $image }}" class="d-block w-100" alt="{{ $name }}">
            @if ($saved)
                <button class="btn btn-warning" wire:click='releasePokemon'>Release Pokemon</button>
            @else
                <button class="btn btn-primary" wire:click='catchPokemon'>Catch Pokemon</button>
            @endif
        </div>
        <div class="col-md-4 center">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($images as $key => $item)
                        <button type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="{{ $key }}" class="active" aria-current="true"
                            aria-label="Image {{ $key }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($images as $key => $item)
                        <div class="carousel-item @if ($loop->iteration == 1) active @endif">
                            <img src="{{ $item }}" class="d-block w-100" alt="{{ $item }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $key }}</h5>
                                {{-- <p>Some representative placeholder content for the first slide.</p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <h3>Description</h3>
        <div class="col-lg-8">
            <h5>Moves</h5>
            <p>{{ implode(', ', $moves) }}</p>
        </div>
        <div class="col-lg-2">
            <h5>Type</h5>
            <p class="text-start">{{ implode(', ', $types) }}</p>
        </div>
    </div>
</div>
