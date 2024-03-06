@extends('layouts.app')

@section('title', 'All Apartments')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="col-md-12 pt-3">
                    <h1 class="font-weight-bold">
                        {{ $apartment->title }}
                    </h1>

                    <img src="{{ $apartment->img_url }}" class="img-fluid" alt="">

                    <p class="mt-3">
                       <strong>Indirizzo:</strong>  {{ $apartment->address }}
                    </p>
                    <p>
                        {{ $apartment->description }}
                    </p>
                    <p>
                        <strong>Numero di stanze:</strong> {{ $apartment->room_number }}
                    </p>
                    <p>
                        <strong>Numero di letti:</strong> {{ $apartment->bed_number }}
                    </p>
                    <p>
                        <strong>Numero di quadrati:</strong> {{ $apartment->square_meters }}
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

                    <!-- Ora puoi includere direttamente la stringa SVG nella tua vista Blade -->





                </div>
            </div>
        </div>
    </div>
@endsection
