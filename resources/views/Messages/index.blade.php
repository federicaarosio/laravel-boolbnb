@extends('layouts.app')

@section('title', 'Appartamenti')

@section('main-content')
    <img src="{{ asset('img/wave.svg') }}" class="position-absolute w-100 bottom-0 my-shape d-none d-md-block">
    <div class="container mt-3 mt-md-5">
        <div class="row my-row rounded-5 p-4">
            <div class="col-12 my-text-primary fw-medium d-flex justify-content-between align-items-start">
                <h1 class="mb-5">I tuoi messaggi</h1>
                <a class="fs-3 fw-semibold pt-1 link-underline-opacity-0 link-underline my-text-primary" href="{{ route('apartments.show', $messages[0]->apartment_id) }}"> < </a>
            </div>
            <div class="col-12">
                    <table class="table">
                        <thead class="my-text-primary">
                            <tr class="my-text-primary">
                                <th scope="col" class="my-text-primary">Mittente</th>
                                <th scope="col" class="my-text-primary d-none d-lg-table-cell">Email</th>
                                <th scope="col" class="my-text-primary d-none d-lg-table-cell">Data invio</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->name }} {{ $message->surname }}</td>
                                <td class="d-none d-lg-table-cell">{{ $message->email }}</td>
                                <td class="d-none d-lg-table-cell">{{ \Carbon\Carbon::parse($message->created_at)->format('d-m-Y H:i')}}</td>
                                <td>
                                    <div class="d-flex justify-content-end align-items-center h-100 flex-column flex-md-row">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm custom-btn-purple me-3" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $message->id }}">
                                            Dettagli
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="detailModal-{{ $message->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5 my-text-primary" id="detailModalLabel">Dettagli messaggio</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $message->content }}
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn custom-btn-purple" data-bs-dismiss="modal">Chiudi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm custom-btn-purple" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $message->id }}">
                                            Cancella
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal-{{ $message->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5 text-danger" id="deleteModalLabel">Cancella Messaggio</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Sei sicuro di voler eliminare il messaggio?<br>
                                                        Dopo la cancellazione, non sarai piu' in grado di ripristinarlo.
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                    <form class="d-inline-block" action="{{ route('messages.destroy', $message) }}" method="POST">
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
    </div>
@endsection