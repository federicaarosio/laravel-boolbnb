@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('main-content')
    <section class="p-5 container">
        <h1 class="text-center">@yield('heading')</h1>

        <form action="@yield('action')" method="POST" enctype="multipart/form-data">
            @csrf
            @yield('method')
            <div class="mb-3">
                <label for="title" class="form-label">Nome Appartamento*</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $apartment->title) }}">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione*</label>
                {{-- <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $apartment->description) }}"> --}}
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $apartment->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="mb-3">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoria Appartamento:*</label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option selected>Scegli una Categoria</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id}}"{{ $category->id == old('category_id', $apartment->category_id) ? 'selected' : '' }}>
                            {{$category->name}}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="room_number" class="form-label">Numero Stanze*</label>
                <input type="number" class="form-control @error('room_number') is-invalid @enderror" name="room_number" id="room_number" value="{{ old('room_number', $apartment->room_number) }}">
                @error('room_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bed_number" class="form-label">Numero Letti*</label>
                <input type="number" class="form-control @error('bed_number') is-invalid @enderror" name="bed_number" id="bed_number" value="{{ old('bed_number', $apartment->bed_number) }}">
                @error('bed_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="toilet_number" class="form-label">Numero Bagni*</label>
                <input type="number" class="form-control @error('toilet_number') is-invalid @enderror" name="toilet_number" id="toilet_number" value="{{ old('toilet_number', $apartment->toilet_number) }}">
                @error('toilet_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri Quadri Totali*</label>
                <input type="number" class="form-control @error('square_meters') is-invalid @enderror" name="square_meters" id="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
                @error('square_meters')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="img_url" class="form-label">Immagine Appartamento*</label>
                <input type="file" class="form-control @error('img_url') is-invalid @enderror" name="img_url" id="img_url" value="{{ str_starts_with(old('img_url', $apartment->img_url), 'http') ? old('img_url', $apartment->img_url) : '' }}">
                @error('img_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name='imageOrUrl' id="fileRadio" value="file" checked>
                    <label class="form-check-label" for="fileRadio">File</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name='imageOrUrl' value="url" id="urlRadio">
                    <label class="form-check-label" for="urlRadio">Url</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo*</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address', $apartment->address) }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" @checked(old('is_visible', $apartment->is_visible)) checked>
                    <label class="form-check-label" for="is_visible">
                        Visibile
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <label for="" class="d-block @error('address') is-invalid @enderror">Servizi*</label>
                @foreach ($services as $service)
                <div class="form-check-inline">
                    <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" id="check-{{ $service->id }}"
                    @checked(in_array( $service->id, old('services', $apartment->services->pluck('id')->toArray())))>
                    <label class="form-check-label" for="check-{{ $service->id }}">
                        {{ $service->name }}
                    </label>
                </div>
                @endforeach
                @error('services')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger">@yield('button-text')</button>
        </form>
    </section>

    <script>
        let fileRadio = document.getElementById('fileRadio');
        let urlRadio = document.getElementById('urlRadio');
        let input = document.getElementById('img_url');

        fileRadio.addEventListener('change', () => {
            if (fileRadio.checked) {
                input.setAttribute('type', 'file');
            } else {
                input.setAttribute('type', 'text');
            }
        });

        urlRadio.addEventListener('change', () => {
            if (urlRadio.checked) {
                input.setAttribute('type', 'text');
            } else {
                input.setAttribute('type', 'file');
            }
        });
    </script>
@endsection
