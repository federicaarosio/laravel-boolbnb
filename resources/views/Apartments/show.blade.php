@extends('layouts.app')

@section('title', 'Dettagli Appartamento')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col-md-12 pt-3">
                    <h1 class="font-weight-bold">
                        {{ $apartment->title }}
                    </h1>

                    @if ( str_starts_with($apartment->img_url, 'http'))
                        <img src="{{ $apartment->img_url }}">
                    @else
                        <img src="{{ asset('storage') . '/' . $apartment->img_url }}">
                    @endif
                    @if ($apartment->sponsors->isNotEmpty())
                        <div class="my-2">
                            <span class="badge rounded-pill my-bg-primary me-1 p-2" >Sponsorizzato</span>
                            Fino al {{ $apartment->sponsors[count($apartment->sponsors) - 1]->pivot->expiry_date }}
                        </div>
                    @endif

                    <p class="mt-3">
                        <strong>Indirizzo:</strong> {{ $apartment->address }}
                    </p>
                    <p>
                        <strong>Descrizione:</strong> {{ $apartment->description }}
                    </p>
                    <p>
                        <strong>Numero di stanze:</strong> {{ $apartment->room_number }}
                    </p>
                    <p>
                        <strong>Numero di letti:</strong> {{ $apartment->bed_number }}
                    </p>
                    <p>
                        <strong>Numero di metri quadrati:</strong> {{ $apartment->square_meters }}
                    </p>

                    <h3 class="mt-3">Cosa troverai:</h3>
                    <div class=" d-flex flex-wrap">
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

                            <div class="col-md-3 mb-3">
                                <div class="w-50 h-50 p-1 ">
                                    {!! $svg !!}
                                    <span class="d-block text-center mt-2">{{ $service->name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
@endsection
