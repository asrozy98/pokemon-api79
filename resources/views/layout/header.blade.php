<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="@if (request()->segment(1) == null) navbar-brand @else link-dark @endif"
            href="{{ url('/') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if (request()->segment(1) == 'my-pokemon') active @endif"
                        href="{{ url('my-pokemon') }}">My Pokemon</a>
                </li>
            </ul>
            {{-- <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-dark" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>
