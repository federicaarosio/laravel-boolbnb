@extends('layouts.app')

@section('main-content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card rounded-5 px-5 py-3">
                {{-- <div class="card-header">Accedi</div> --}}

                <div class="card-body ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center mb-3">
                            <img src="{{ asset('img/logoBoolbnb.png') }}" height="70">
                        </div>
                        <h2 class="mb-3 text-center p-0 fw-bold my-text-primary">Bentornato!</h2>
                        <h5 class="mb-4 text-center p-0">Accedi per continuare</h5>

                        <div class="mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-start fs-5">Email</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="p-3 my-check form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 ">
                            <label for="password" class="col-md-4 col-form-label text-md-start fs-5">Password</label>

                            <div class="col-md-12 ">
                                <input id="password" type="password" class="p-3 my-check form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check ">
                                        <input class="form-check-input my-check" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">{{ __('Ricordami') }}</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn fs-6 link-underline link-underline-opacity-0 p-0" href="{{ route('password.request') }}">
                                            Hai dimenticato la password?
                                        </a>
                                    @endif
                                </div>   
                                <button type="submit" class="text-white btn mb-3 mt-5 p-3 fs-4 rounded-3 w-100 my-btn">
                                    Accedi
                                </button>
                                <a class="btn fs-5 link-underline link-underline-opacity-0 p-0" href="{{ route('register') }}">
                                    <span class="my-text-primary">Registrati</span> su Boolbnb
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
