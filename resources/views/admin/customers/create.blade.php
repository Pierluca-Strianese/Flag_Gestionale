@extends('admin.layouts.base')

@section('contents')
    <form method="POST" action="{{ route('dashboard.customers.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        <h1 class="text-primary border-bottom border-primary p-2 col-3">Nuovo Preventivo</h1>
        <div class="row">
            <section class="container-sm bg-body-secondary p-4 my-4 rounded col-8">
                <div class="mb-3 row">
                    <h3 class="border-bottom mb-4 pb-2"> Dati </h3>
                    <div class="col-12">
                        <label for="CF" class="form-label ps-2">Nome azienda</label>
                        <input type="text" class="form-control @error('NomeAzienda') is-invalid @enderror"
                            id="NomeAzienda" name="NomeAzienda" value="{{ old('NomeAzienda') }}">

                        <div class="invalid-feedback">
                            @error('NomeAzienda')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-6">
                        <label for="CF" class="form-label ps-2">Codice Fiscale</label>
                        <input type="text" class="form-control @error('CF') is-invalid @enderror" id="CF"
                            name="CF" value="{{ old('CF') }}">
                        <div class="invalid-feedback">
                            @error('CF')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PIVA" class="form-label ps-2">P.IVA</label>
                            <input type="text" class="form-control @error('PIVA') is-invalid @enderror" id="PIVA"
                                name="PIVA" value="{{ old('PIVA') }}">
                            <div class="invalid-feedback">
                                @error('PIVA')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="mail" class="form-label ps-2">Mail</label>
                        <input type="text" class="form-control @error('mail') is-invalid @enderror" id="mail"
                            name="mail" value="{{ old('mail') }}">
                        <div class="invalid-feedback">
                            @error('mail')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-5">
                        <label for="telefono" class="form-label ps-2">Telefono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                            name="telefono" value="{{ old('telefono') }}">
                        <div class="invalid-feedback">
                            @error('telefono')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <h4 class="border-top ps-2 pt-2 col-4">Indirizzo di fatturazione</h4>
                <div class="my-3 row">
                    <div class="col-7">
                        <label for="indirizzo" class="form-label ps-2">Via</label>
                        <input type="text" class="form-control @error('indirizzo') is-invalid @enderror" id="indirizzo"
                            name="indirizzo" value="{{ old('indirizzo') }}">
                        <div class="invalid-feedback">
                            @error('indirizzo')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="n_civico" class="form-label ps-2">N.</label>
                        <input type="text" class="form-control @error('n_civico') is-invalid @enderror" id="n_civico"
                            name="n_civico" value="{{ old('n_civico') }}">
                        <div class="invalid-feedback">
                            @error('n_civico')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="CAP" class="form-label ps-2">CAP</label>
                        <input type="text" class="form-control @error('CAP') is-invalid @enderror" id="CAP"
                            name="CAP" value="{{ old('CAP') }}">
                        <div class="invalid-feedback">
                            @error('CAP')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-7">
                        <label for="citta" class="form-label ps-2">Città</label>
                        <input type="text" class="form-control @error('citta') is-invalid @enderror" id="citta"
                            name="citta" value="{{ old('citta') }}">
                        <div class="invalid-feedback">
                            @error('citta')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="provincia" class="form-label ps-2">Provincia</label>
                        <input type="text" class="form-control @error('provincia') is-invalid @enderror" id="provincia"
                            name="provincia" value="{{ old('provincia') }}">
                        <div class="invalid-feedback">
                            @error('provincia')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="nazione" class="form-label ps-2">Nazione</label>
                        <input type="text" class="form-control @error('nazione') is-invalid @enderror" id="nazione"
                            name="nazione" value="{{ old('nazione') }}">
                        <div class="invalid-feedback">
                            @error('nazione')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </section>

            <section class="container-sm bg-body-secondary p-4 my-4 rounded col-8">
                <h3 class="border-bottom mb-4 pb-2">Pagamento</h3>
                <div class="mb-3 row">
                    <div class="col-6">
                        <label for="IBAN" class="form-label ps-2">IBAN</label>
                        <input type="text" class="form-control @error('IBAN') is-invalid @enderror" id="IBAN"
                            name="IBAN" value="{{ old('IBAN') }}">
                        <div class="invalid-feedback">
                            @error('IBAN')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="MetodoPagamento" class="form-label ps-2">Metodo di pagamento</label>
                        <select class="form-select" aria-label="Default select example"
                            @error('MetodoPagamento') is-invalid @enderror id="MetodoPagamento" name="MetodoPagamento"
                            value="{{ old('MetodoPagamento') }}">
                            <option selected>Seleziona il metodo di pagamento</option>
                            <option value="Carta di Credito">Carta di Credito</option>
                            <option value="PayPal">PayPal</option>
                            <option value="Bonifico">Bonifico</option>
                            <option value="Nessuno">Nessuno</option>
                        </select>
                        <div class="invalid-feedback">
                            @error('MetodoPagamento')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-4">
                        <label for="pagamento_tot" class="form-label ps-2">Totale pagamento</label>
                        <input type="text" class="form-control @error('pagamento_tot') is-invalid @enderror"
                            id="pagamento_tot" name="pagamento_tot" value="{{ old('pagamento_tot') }}">
                        <div class="invalid-feedback">
                            @error('pagamento_tot')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="rata_mensile" class="form-label ps-2">Rata mensile</label>
                        <input type="text" class="form-control @error('rata_mensile') is-invalid @enderror"
                            id="rata_mensile" name="rata_mensile" value="{{ old('rata_mensile') }}">
                        <div class="invalid-feedback">
                            @error('rata_mensile')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="acconto" class="form-label ps-2">Acconto</label>
                        <input type="text" class="form-control @error('acconto') is-invalid @enderror" id="acconto"
                            name="acconto" value="{{ old('acconto') }}">
                        <div class="invalid-feedback">
                            @error('acconto')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-6">
                        <label for="data_inizio_contratto" class="form-label ps-2">Data inizio contratto</label>
                        <input type="date" class="form-control @error('data_inizio_contratto') is-invalid @enderror"
                            id="data_inizio_contratto" name="data_inizio_contratto"
                            value="{{ old('data_inizio_contratto') }}">
                        <div class="invalid-feedback">
                            @error('data_inizio_contratto')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="durata_contratto_mesi" class="form-label ps-2">Durata contratto (mesi)</label>
                        <input type="text" class="form-control @error('durata_contratto_mesi') is-invalid @enderror"
                            id="durata_contratto_mesi" name="durata_contratto_mesi"
                            value="{{ old('durata_contratto_mesi') }}">
                        <div class="invalid-feedback">
                            @error('durata_contratto_mesi')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3 row" id="rate-container"></div>

                <div class="mb-3">
                    <label for="note" class="form-label ps-2">Note</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" rows="3" name="note"
                        value="{{ old('note') }}"></textarea>
                    <div class="invalid-feedback">
                        @error('note')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

            </section>
            <div class="mb-5 text-center">
                <button class="btn btn-lg btn-primary">Crea</button>
            </div>
        </div>

        </section>
    </form>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const durataContrattoInput = document.getElementById('durata_contratto_mesi');
        const rateContainer = document.getElementById('rate-container');

        durataContrattoInput.addEventListener('input', function() {
            const numRate = parseInt(this.value, 10);

            if (!isNaN(numRate)) {
                rateContainer.innerHTML = '';

                for (let i = 1; i <= numRate; i++) {
                    const label = document.createElement('label');
                    label.innerHTML = `${i}° Rata`;

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = `rate_pagate[rata_${i}][pagata]`;
                    checkbox.className = 'form-check-input';

                    // Aggiungi un campo di input per la data di pagamento
                    const dateInput = document.createElement('input');
                    dateInput.type = 'date';
                    dateInput.name = `rate_pagate[rata_${i}][data_pagamento]`;
                    dateInput.className = 'form-control'; // Modifica la classe a seconda del tuo stile
                    dateInput.placeholder = 'Data pagamento';

                    const div = document.createElement('div');
                    div.className =
                    'col-3 m-2 form-check'; // Modifica la classe a seconda del tuo stile
                    div.appendChild(label);
                    div.appendChild(checkbox);
                    div.appendChild(dateInput);

                    rateContainer.appendChild(div);
                }
            }
        });
    });
</script>
