@extends('layouts.app')

@section('title', 'Appartamenti')

@section('head')
    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('main-content')
    <div id="sponsors" class="container-fluid">
        <div class="row justify-content-evenly">
            <div class="col-4">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h1 class="my-text-primary mb-3">Servizio di Sponsorizzazione per Host</h1>
                        <p class="fs-5">Benvenuto nel nostro servizio di sponsorizzazione premium, progettato per gli host che desiderano massimizzare la visibilità e aumentare le probabilità di prenotazione del loro appartamento. <br/> Attraverso questa sponsorizzazione, garantiamo che il tuo alloggio riceva la massima esposizione su tutte le piattaforme.</p>
                    </div>
                    <div class="col-4 mb-5">
                        <p class="my-text-primary mb-1 fw-semibold">Posizionamento in Prima Pagina</p>
                        <p>Il tuo appartamento sarà presentato in cima agli elenchi di ricerca e sarà il primo ad essere visualizzato dagli utenti che visitano la nostra homepage.</p>
                    </div>
                    <div class="col-4">
                        <p class="my-text-primary mb-1 fw-semibold ">Visibilità Elevata</p>
                        <p>Grazie al nostro algoritmo avanzato, il tuo appartamento sarà raccomandato agli utenti che corrispondono al profilo ideale del tuo pubblico di riferimento.</p>
                    </div>
                    <div class="col-4">
                        <p class="my-text-primary mb-1 fw-semibold ">Differenziazione dalla Concorrenza</p>
                        <p>La sponsorizzazione premium distingue il tuo appartamento dagli altri alloggi presenti sulla piattaforma grazie alle diverse animazioni esclusive.</p>
                    </div>
                    <div class="col-4">
                        <p class="my-text-primary mb-1 fw-semibold">Incremento delle Prenotazioni</p>
                        <p>Gli alloggi sponsorizzati tendono ad attrarre un numero maggiore di prenotazioni rispetto alla media.</p>
                    </div>
                    <div class="col-4">
                        <p class="my-text-primary mb-1 fw-semibold ">Feedback e Recensioni Prioritarie</p>
                        <p>Gli ospiti che prenotano il tuo alloggio tramite il nostro servizio di sponsorizzazione premium avranno la possibilità di fornire feedback e recensioni prioritarie.</p>
                    </div>
                    <div class="col-4">
                        <p class="my-text-primary mb-1 fw-semibold ">Supporto Personalizzato</p>
                        <p>Il nostro team dedicato è sempre disponibile per assisterti e fornirti consulenza su come ottimizzare la tua sponsorizzazione per massimizzare i risultati.</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card rounded-4">
                    <div class="card-body">
                        <h1 class="mb-3 my-text-primary fw-medium">Sponsorizza</h1>
                        <div id="messageHandler">

                        </div>
                        <div class="mb-3">
                            <label for="apartment_id" class="form-label">Seleziona l'appartamento da sponsorizzare</label>
                            <select class="form-select form-select-lg" id="apartment_id">
                                <option>Seleziona un appartamento</option>
                                @foreach ($apartments as $apartment)
                                <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="sponsor_id" class="form-label ">Seleziona il tipo di sponsor</label>
                            <select class="form-select form-select-lg" id="sponsor_id">
                                <option>Seleziona una sponsor</option>
                                @foreach ($sponsors as $sponsor)
                                    <option value="{{ $sponsor->id }}"> {{ $sponsor->name }} - {{ substr($sponsor->duration, 0, 3) }} Hours - {{ $sponsor->price }} </option>
                                @endforeach
                            </select>
                        </div>
                        <form id="payment-form">
                            <input type="hidden" id="nonce" name="payment_method_nonce" />
                            <div id="dropin-container"></div>
                            <input class="btn my-bg-primary" type="submit" id="send"></input>
                        </form>
                    </div>
                </div>
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
                            if(response.data.success === true) {
                                const messageHandler = document.getElementById('messageHandler');
                                messageHandler.innerHTML = '';
                                const messageEl = document.createElement('div');
                                messageEl.classList.add('alert', 'my-alert');
                                messageEl.textContent = 'Sponsorizzazione effettuata con successo!';
                                messageHandler.append(messageEl);
                            }
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