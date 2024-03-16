@extends('layouts.app')

@section('title', 'Dettagli Appartamento')

@section('main-content')
    <div class="container">
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
        </div>
    @endsection
