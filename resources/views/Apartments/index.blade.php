@extends('layouts.app')

@section('title', 'Appartamenti')

@section('main-content')
<img src="{{ asset('img/wave.svg') }}" class="position-absolute w-100 bottom-0 my-shape d-none d-md-block">
<div class="container mt-3 mt-md-5">
    <div class="row my-row rounded-5 p-4">
        <div class="col-12 my-text-primary fw-medium d-flex justify-content-between align-items-start">
            <h1 class="mb-5">I tuoi appartamenti</h1>
            <div class="pt-2 text-end text-md-start">
                <a class="btn rounded-4 my-text-primary" href="{{ route('apartments.sponsors') }}">Sponsorizza</a>
                <a class="btn rounded-4 my-text-primary" href="{{ route('apartments.create') }}">Aggiungi</a>
            </div>
        </div>
        <div class="col-12">
            @if(session('message'))
                <div class="alert alert-success d-flex justify-content-between" role="alert" id="alert" onload="closeButton">
                    {{ session('message') }}
                    <button type="button" class="btn-close" id="close"></button>
                </div>
            @endif
        </div>
        <div class="col-12 my-3 text-end d-none">
            <a class="btn btn-secondary" href="{{ route('apartments.sponsors') }}">Sponsorizza</a>
            <a class="btn btn-primary" href="{{ route('apartments.create') }}">Crea un Appartamento</a>
        </div>
        <div class="col-12">
                <table class="table">
                    <thead class="my-text-primary">
                        <tr class="my-text-primary">
                            <th scope="col" class="my-text-primary">Nome Appartamento</th>
                            <th scope="col" class="my-text-primary d-none d-lg-table-cell">Indirizzo</th>
                            <th scope="col" class="my-text-primary d-none d-xl-table-cell">Categoria</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                        <tr>
                            <td>{{ $apartment -> title }}</td>
                            <td class="d-none d-lg-table-cell">{{ $apartment -> address }}</td>
                            <td class="d-none d-xl-table-cell">{{ $apartment -> category -> name}}</td>
                            <td>
                                <div class="d-flex justify-content-evenly align-items-center h-100 flex-column flex-md-row">
                                    <a class="btn btn-sm custom-btn-purple mb-1 mb-sm-0" href="{{ route('apartments.show', $apartment) }}">
                                        Dettagli
                                    </a>
                                    <a class="btn btn-sm custom-btn-purple mb-1 mb-sm-0" href="{{ route('apartments.edit', $apartment) }}">
                                        Modifica
                                    </a>
    
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm custom-btn-purple" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $apartment->id }}">
                                        Cancella
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{ $apartment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Cancella Appartamento</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Sei sicuro di voler eliminare l'appartamento "<strong>{{ $apartment->title }}</strong>" ?<br>
                                                    Dopo la cancellazione, non sarai piu' in grado di ripristinarlo.
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                <form class="d-inline-block" action="{{ route('apartments.destroy', $apartment) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">
                                                        Cancella
                                                    </button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Script JS --}}
    <script>
        function closeButton() {
            let closebutton = document.getElementById('close');
            let alertElement = document.getElementById('alert');
            closebutton.addEventListener('click', () => {
                alertElement.classList.add('d-none');
            });
        }
    </script>
@endsection