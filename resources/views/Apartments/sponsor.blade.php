@extends('layouts.app')

@section('title', 'Appartamenti')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('main-content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-6">
                        <select class="form-select" id="apartment_id">
                            <option >Seleziona un appartamento</option>
                            @foreach ($apartments as $apartment)
                                <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="form-select" id="sponsor_id">
                            <option>Seleziona una sponsor</option>
                            @foreach ($sponsors as $sponsor)
                                <option value="{{ $sponsor->id }}"> {{ $sponsor->name }} - {{ substr($sponsor->duration, 0, 2) }} Hours - {{ $sponsor->price }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <form id="payment-form">
                    <input type="hidden" id="nonce" name="payment_method_nonce" />
                    <div id="dropin-container"></div>
                    <input class="btn btn-primary" type="submit" id="send"></input>
                </form>
            </div>
        </div>
    </div>

    <script>
        axios.get('{{ route('payment.token') }}')
        .then(function (response) {
            const form = document.getElementById('payment-form');

            braintree.dropin.create({
            authorization: response.data,
            container: document.getElementById('dropin-container'),
            }).then((dropinInstance) => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const apartmentValue = document.getElementById('apartment_id').value;
                    const sponsorValue = document.getElementById('sponsor_id').value;

                    dropinInstance.requestPaymentMethod().then((payload) => {
                        document.getElementById('nonce').value = payload.nonce;

                        axios.post('{{ route('payment.process') }}', {
                            apartment_id: apartmentValue,
                            sponsor_id: sponsorValue,
                            nonce: payload.nonce
                        })
                        .then(function (response) {
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }).catch((error) => { throw error; });
                });
            }).catch((error) => {
                console.log(error);
            });
        })
        .catch(function (error) {
            console.log(error);
        });
    </script>
@endsection