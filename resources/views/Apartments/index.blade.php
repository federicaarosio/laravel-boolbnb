@extends('layouts.app')

@section('title', 'Appartamenti')

@section('main-content')

<div class="container">
    <div class="row">
        <div class="col-12 text-center ">
            <h1 class='py-4'>Questi sono tutti i tuoi appartamenti, {{ Auth::user()->name }}</h1>
        </div>
        <div class="col-12">
            @if(session('message'))
                <div class="alert alert-success d-flex justify-content-between" role="alert" id="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" id="close"></button>
                </div>
            @endif
        </div>
        <div class="col-12 my-3 text-end">
            <a class="btn btn-secondary" href="{{ route('apartments.sponsors') }}">Sponsorizza</a>
            <a class="btn btn-primary" href="{{ route('apartments.create') }}">Crea un Appartamento</a>
        </div>
        <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome Appartamento</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Opzioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                        <tr>
                            <td>{{ $apartment -> title }}</td>
                            <td>{{ $apartment -> address }}</td>
                            <td>{{ $apartment -> category -> name}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('apartments.show', $apartment) }}">
                                    Dettagli
                                </a>
                                <a class="btn btn-sm btn-success" href="{{ route('apartments.edit', $apartment) }}">
                                    Modifica
                                </a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $apartment->id }}">
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
        let closebutton = document.getElementById('close');
        let alertElement = document.getElementById('alert');
        closebutton.addEventListener('click', () => {
            alertElement.classList.add('d-none');
        });
    </script>
@endsection