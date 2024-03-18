@extends('layouts.app')

@section('title', 'Dettagli Appartamento')

@section('main-content')
    {{-- <div class="container">
        <div class="row">
            <div class="col-12 mt-2 mb-3">
                <h1 class="fs-2">
                    {{ $apartment->title }}
                </h1>
            </div>

                @if (str_starts_with($apartment->img_url, 'http'))
                    <div class="col-12 d-flex mb-3">
                        <img class="rounded-4 object-fit-cover w-100 " src="{{ $apartment->img_url }}">
                    </div>
                @else
                    <div class="col-12 d-flex mb-3">
                        <img class="rounded-4 object-fit-cover w-100 "
                            src="{{ asset('storage') . '/' . $apartment->img_url }}">
                    </div>
                @endif

                <div class="col-7">
                    <div class="row">
                        <div class="col-12">

                            <p class="fs-5 fs-md-2 fw-semibold m-0 pt-2">
                                {{ $apartment->address }}
                                @if ($apartment->sponsors->isNotEmpty())
                                    <span class="badge rounded-pill my-bg-primary me-1 p-2">Sponsorizzato</span>
                                    Fino al
                                    {{ $apartment->sponsors[count($apartment->sponsors) - 1]->pivot->expiry_date }}
                                @endif
                            </p>
                            <p class="mb-1"> {{ $apartment->bed_number }} bagni · {{ $apartment->room_number }} stanze
                                · {{ $apartment->square_meters }} metri quadrati </p>
                            <hr>

                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center ">
                                <img src="../assets/img/placeholder.svg" class="rounded-circle me-3">
                                <span>
                                    <p class="m-0 fw-semibold ">Nome dell'host: {{ $apartment->user->name }}</p>

                                </span>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <p class="fs-4 fw-semibold ">Descrizione</p>
                            <p class="pb-3">{{ $apartment->description }}</p>
                            <hr>
                        </div>
                        <div class="col-12">
                            <p class="fs-4 fw-semibold ">Cosa troverai</p>
                            <div class=" row">

                                @foreach ($apartment->services as $service)
                                    @php
                                        // Crea un nuovo oggetto DOM con la stringa SVG come contenuto
                                        $dom = new DOMDocument();
                                        $dom->loadXML($service->image);

                                        // Ottieni il nodo radice SVG
                                        $svgElement = $dom->documentElement;

                                        // Serializza il nodo SVG in una stringa
                                        $svg = $dom->saveXML($svgElement);
                                    @endphp
                                    <div class="col-5 d-flex mb-3 w-25">
                                        <div class="w-25 me-2">
                                            {!! $svg !!}
                                            <span class="d-block text-center mt-2">{{ $service->name }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-5 py-2 ps-5">
                    <div class="card ms-3 me-1 px-1 ">
                        <div class="card-body">

                            <ul class="list-group mb-5">
                                @foreach ($apartment->messages as $message)
                                    <li class="list-group-item">
                                        <p class="m-0">messaggio da: {{ $message->name }}</p>
                                        <p>{{ $message->content }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
        <img src="{{ asset('img/wave.svg') }}" class="position-absolute w-100 bottom-0 ">
        <div id="show" class="container-fluid">
            <div class="row justify-content-evenly ">
                <div class="col-5">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <h1 class="fs-2 my-text-primary">
                                {{ $apartment->title }}
                            </h1>
                        </div>
                        <div class="col-6 mb-2">
                            <img class="rounded-4 object-fit-cover w-100 " src="{{ $apartment->img_url }}">
                        </div>
                        <div class="col-6">
                            <p class="fw-semibold fs-5 mb-1">{{ $apartment->address }}</p>
                            <p class="fw-semibold my-text-primary mb-2">Caratteristiche</p>
                            <p class="mb-1">{{ $apartment->square_meters }} m<sup>2</sup></p>
                            <p class="mb-1">Stanze: <span class="my-text-primary fw-semibold ">{{ $apartment->room_number }}</span> </p>
                            <p class="mb-1">Letti: <span class="my-text-primary fw-semibold ">{{ $apartment->bed_number }}</span></p>
                            <p class="mb-2">Bagni: <span class="my-text-primary fw-semibold ">{{ $apartment->toilet_number }}</span></p>
                            <p class="fw-semibold my-text-primary mb-2">Categoria</p>
                            <p class="mb-2 d-flex align-items-center ">
                                {{ $apartment->category->name }}
                                <img src="{{ $apartment->category->img_url }}" class="category-img">
                            </p>
                            <p class="fw-semibold my-text-primary mb-2">
                                Sponsorizzazione 
                                @if ($apartment->sponsors->isNotEmpty())
                                    <span class="badge rounded-pill my-bg-primary me-1 p-2">Attiva</span>
                                @else
                                    <span class="badge rounded-pill my-bg-primary me-1 p-2">Non Attiva</span>
                                @endif
                            </p>
                            @if ($apartment->sponsors->isNotEmpty())
                                <div class="mb-2">
                                    Scade il
                                    {{ \Carbon\Carbon::parse($apartment->sponsors[count($apartment->sponsors) - 1]->pivot->expiry_date)->format('d-m-Y H:i')}}
                                </div>
                            @endif

                        </div>
                        <div class="col-12">
                            <p class="fw-semibold my-text-primary mb-2">Descrizione</p>
                            <p class="mb-1">{{ $apartment->description }}</p>
                            <p class="fw-semibold my-text-primary mb-2">Servizi</p>
                            <div class="row">
                                @foreach ($apartment->services as $service)
                                    @php
                                        // Crea un nuovo oggetto DOM con la stringa SVG come contenuto
                                        $dom = new DOMDocument();
                                        $dom->loadXML($service->image);
    
                                        // Ottieni il nodo radice SVG
                                        $svgElement = $dom->documentElement;
    
                                        // Serializza il nodo SVG in una stringa
                                        $svg = $dom->saveXML($svgElement);
                                    @endphp
                                    <div class="col-4 mb-2">
                                        <span class="svg">
                                            {!! $svg !!}
                                        </span>
                                        <span class="text">{{ $service->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <h1 class="mb-3 my-text-primary fw-medium">Messaggi</h1>
                            @if ($apartment->messages->isNotEmpty())
                                <ul class="list-group mb-3">
                                    @for ($i = 0; $i < (count($apartment->messages) < 5 ? count($apartment->messages) : 5 ); $i++)
                                        <li class="list-group-item d-flex justify-content-between align-items-center ">
                                            <span>
                                                Ricevuto da <span class="my-text-primary">{{ $apartment->messages[$i]->name }} </span>
                                                il {{ \Carbon\Carbon::parse($apartment->messages[$i]->created_at)->format('d-m H:i')}}
                                            </span>

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
                                                            Sei sicuro di voler eliminare il messaggio ?<br>
                                                            Dopo la cancellazione, non sarai piu' in grado di ripristinarlo.
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                                        <form class="d-inline-block" action="{{ route('messages.destroy', ['message' => $apartment->messages[$i], 'index' => false]) }}" method="POST">
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
                                        </li>
                                    @endfor
                                </ul>
                            @else
                                <div class="text-center fs-5 fw-semibold ">
                                    <p>Nessun messaggio</p>
                                </div>
                            @endif
                            <div class="text-center">
                                @if ($apartment->messages->isNotEmpty())
                                    <a class="btn btn-sm custom-btn-purple mb-1" href="{{ route('messages.index', ['apartment_id' => $apartment->id]) }}">
                                        Mostra Tutti
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        @endsection
