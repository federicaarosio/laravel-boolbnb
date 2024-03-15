@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

            <div class="mb-3 position-relative">
                <label for="address" class="form-label">Indirizzo*</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address', $apartment->address) }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <ul id="results" class="d-none overflow-hidden list-unstyled position-absolute w-50"></ul>
            </div>

            <div id="room_number_wrapper" class="mb-3">
                <label for="room_number" class="form-label">Numero Stanze*</label>
                <input type="number" class="form-control @error('room_number') is-invalid @enderror numberValidation" name="room_number" id="room_number" value="{{ old('room_number', $apartment->room_number) }}">
                @error('room_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bed_number" class="form-label">Numero Letti*</label>
                <input type="number" class="form-control @error('bed_number') is-invalid @enderror numberValidation" name="bed_number" id="bed_number" value="{{ old('bed_number', $apartment->bed_number) }}">
                @error('bed_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="toilet_number" class="form-label">Numero Bagni*</label>
                <input type="number" class="form-control @error('toilet_number') is-invalid @enderror numberValidation" name="toilet_number" id="toilet_number" value="{{ old('toilet_number', $apartment->toilet_number) }}">
                @error('toilet_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri Quadri Totali*</label>
                <input type="number" class="form-control @error('square_meters') is-invalid @enderror numberValidation" name="square_meters" id="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
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

    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/services/services-web.min.js"></script>

    <script>
        // Image Input Switch
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

        // // Autocomplete
        // const queryInput = document.getElementById('address');
        // const resultsContainer = document.getElementById('results');

        // queryInput.addEventListener('input', () => {
        //     resultsContainer.innerHTML = '';
        //     let queryValue = queryInput.value;
        //     queryValue.length <= 3 ? resultsContainer.classList.add('d-none') : '';
        //     if(queryValue.length > 3) {
        //         tt.services.fuzzySearch({
        //         key: "{{ env('TOMTOM_API_KEY') }}",
        //         query: queryValue,
        //         limit: 5,
        //         countrySet: 'IT',
        //         language: 'it-IT',
        //         }).then((response) => {
        //             console.log(response);
        //             let results = response.results;
        //             results.forEach( result => {
        //                 let li = document.createElement('li');
        //                 li.textContent = result.address.freeformAddress;
        //                 li.addEventListener('click', () => {
        //                     queryInput.value = result.address.freeformAddress;
        //                     resultsContainer.classList.add('d-none');
        //                 })
        //                 resultsContainer.append(li);
        //             });
        //             resultsContainer.classList.remove('d-none');
        //         });
        //     }
        // });

        async function file_get_content(uri, callback) {
            let res = await fetch(uri),
                ret = await res.text();
            return callback ? callback(ret) : ret;
        }

        const queryInput = document.getElementById('address');

        queryInput.addEventListener('input', () => {
            const resultsContainer = document.getElementById('results');

            apiKey = "{{ env('TOMTOM_API_KEY') }}";
            addressQuery = queryInput.value.replace(' ', '+')

            let endpoint = `https://api.tomtom.com/search/2/geocode/${addressQuery}.json?key=${apiKey}`

            let results = '';
            resultsContainer.innerHTML = '';

            let queryValue = queryInput.value;
            queryValue.length <= 3 ? resultsContainer.classList.add('d-none') : '';

            if(queryValue.length > 3) {
                file_get_content(endpoint).then( response => {
                    results = JSON.parse(response);
                    console.log(results);
                    
                    for(let i = 0; i < 4; i++) {
                        let li = document.createElement('li');
                        li.textContent = results.results[i].address.freeformAddress;
                        li.addEventListener('click', () => {
                            queryInput.value = results.results[i].address.freeformAddress;
                            resultsContainer.classList.add('d-none');
                        })
                        resultsContainer.append(li);
                    }
                    resultsContainer.classList.remove('d-none');
                });
            }
        })

        // Validation stilosa
        const inputList = document.getElementsByClassName('numberValidation');
        const inputArray = Array.from(inputList);
        inputArray.forEach(element => {
            element.addEventListener('change', () => {
                if(element.value <= 0 && element.value != '') {
                    element.classList.add('is-invalid');
                    let errorEl = document.createElement('span');
                    errorEl.classList.add('invalid-feedback')
                    errorEl.textContent = 'Inserire un numero positivo!'
                    element.insertAdjacentElement('afterend', errorEl)
                } else if(element.value == '') {
                    element.classList.remove('is-invalid');
                }
            });
        });
    </script>
@endsection
