@extends('layout.index')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            @if (request()->segment(1) == null)
                <livewire:home />
            @elseif (request()->segment(1) == 'detail')
                @php
                    $id = request()->segment(2);
                @endphp
                <livewire:detail :pokemon_id="$id" />
            @elseif (request()->segment(1) == 'my-pokemon')
                <livewire:my-pokemon />
            @endif
        </div>
    </div>
@endsection
@push('js')
    <script>
        window.addEventListener('swal:catch', event => {
            if (event.detail.rename) {
                Swal.fire({
                    title: event.detail.message,
                    text: event.detail.text,
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    confirmButtonText: 'Rename',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    var name = result.value;
                    window.livewire.emit('renamePokemon', name);
                });
            } else {

                swal.fire({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                });
            }
        });

        window.addEventListener('swal:release', event => {
            swal.fire({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });

        window.addEventListener('swal:rename', event => {
            if (event.detail.type) {
                swal.fire({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                });
            } else {
                Swal.fire({
                    title: event.detail.message,
                    text: event.detail.text,
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    confirmButtonText: 'Rename',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    var name = result.value;
                    var id = event.detail.id;
                    window.livewire.emit('rename', id, name);
                });
            }
        });
    </script>
@endpush
