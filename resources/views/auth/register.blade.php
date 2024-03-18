@extends('layouts.app')

@section('main-content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card rounded-5 px-5 py-3">

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="text-center mb-3">
                            <img src="{{ asset('img/logoBoolbnb.png') }}" height="70">
                        </div>
                        <h2 class="mb-3 text-center p-0 fw-bold primary-text">Registrati!</h2>

                        <div class="mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-start fs-5">Nome</label>
                            <div class="col-md-12">
                                <input id="name" type="text" class="p-3 my-check form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-start fs-5">Cognome</label>

                            <div class="col-md-12">
                                <input id="surname" type="text" class="p-3 my-check form-control form-control-lg @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-start fs-5">Indirizzo Email*</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="p-3 my-check form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-start fs-5">Password*</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="p-3 my-check form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="col-md-6 col-form-label text-md-start fs-5">Conferma la Password</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="p-3 my-check form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-start fs-5">Anno di nascita</label>

                            <div class="col-md-12">
                                <input id="birth_date" type="date" class="p-3 my-check form-control form-control-lg @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn text-white btn mb-3 mt-3 p-3 fs-4 rounded-3 w-100 my-btn">
                                    Registrati
                                </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
