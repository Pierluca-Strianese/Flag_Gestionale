@extends('admin.layouts.base')

@section('contents')
    <form method="POST" action="{{ route('dashboard.customers.update', ['customer' => $customer]) }}"
        enctype="multipart/form-data" novalidate>
        @csrf
        @method('put')

        <h1 class="text-primary border-bottom border-primary p-2 col-3">Nuovo Preventivo</h1>
        <div class="row">
            <section class="container-sm bg-body-secondary p-4 my-4 rounded col-8">
                <div class="mb-3 row">
                    <h3 class="border-bottom mb-4 pb-2"> Dati </h3>
                    <div class="col-12">
                        <label for="CF" class="form-label ps-2">Nome azienda</label>
                        <input type="text" class="form-control @error('NomeAzienda') is-invalid @enderror"
                            id="NomeAzienda" name="NomeAzienda" value="{{ old('NomeAzienda', $customer->NomeAzienda) }}">

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
                            name="CF" value="{{ old('CF', $customer->CF) }}">
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
                                name="PIVA" value="{{ old('PIVA', $customer->PIVA) }}">
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
                            name="mail" value="{{ old('mail', $customer->mail) }}">
                        <div class="invalid-feedback">
                            @error('mail')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-5">
                        <label for="telefono" class="form-label ps-2">Telefono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                            name="telefono" value="{{ old('telefono', $customer->telefono) }}">
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
                            name="indirizzo" value="{{ old('indirizzo', $customer->indirizzo) }}">
                        <div class="invalid-feedback">
                            @error('indirizzo')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="n_civico" class="form-label ps-2">N.</label>
                        <input type="text" class="form-control @error('n_civico') is-invalid @enderror" id="n_civico"
                            name="n_civico" value="{{ old('n_civico', $customer->n_civico) }}">
                        <div class="invalid-feedback">
                            @error('n_civico')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="CAP" class="form-label ps-2">CAP</label>
                        <input type="text" class="form-control @error('CAP') is-invalid @enderror" id="CAP"
                            name="CAP" value="{{ old('CAP', $customer->CAP) }}">
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
                            name="citta" value="{{ old('citta', $customer->citta) }}">
                        <div class="invalid-feedback">
                            @error('citta')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <label for="provincia" class="form-label ps-2">Provincia</label>
                        <input type="text" class="form-control @error('provincia') is-invalid @enderror" id="provincia"
                            name="provincia" value="{{ old('provincia', $customer->provincia) }}">
                        <div class="invalid-feedback">
                            @error('provincia')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="nazione" class="form-label ps-2">Nazione</label>
                        <input type="text" class="form-control @error('nazione') is-invalid @enderror" id="nazione"
                            name="nazione" value="{{ old('nazione', $customer->nazione) }}">
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
                            name="IBAN" value="{{ old('IBAN', $customer->IBAN) }}">
                        <div class="invalid-feedback">
                            @error('IBAN')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="MetodoPagamento" class="form-label ps-2">Metodo di pagamento</label>
                        <select class="form-select @error('MetodoPagamento') is-invalid @enderror"
                            aria-label="Default select example" id="MetodoPagamento" name="MetodoPagamento">
                            <option value="">Seleziona il metodo di pagamento</option>
                            <option value="Carta di Credito" @if (old('MetodoPagamento', $customer->MetodoPagamento) == 'Carta di Credito') selected @endif>Carta di
                                Credito</option>
                            <option value="PayPal" @if (old('MetodoPagamento', $customer->MetodoPagamento) == 'PayPal') selected @endif>PayPal</option>
                            <option value="Bonifico" @if (old('MetodoPagamento', $customer->MetodoPagamento) == 'Bonifico') selected @endif>Bonifico</option>
                            <option value="Nessuno" @if (old('MetodoPagamento', $customer->MetodoPagamento) == 'Nessuno') selected @endif>Nessuno</option>
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
                            id="pagamento_tot" name="pagamento_tot"
                            value="{{ old('pagamento_tot', $customer->pagamento_tot) }}">
                        <div class="invalid-feedback">
                            @error('pagamento_tot')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="rata_mensile" class="form-label ps-2">Rata mensile</label>
                        <input type="text" class="form-control @error('rata_mensile') is-invalid @enderror"
                            id="rata_mensile" name="rata_mensile"
                            value="{{ old('rata_mensile', $customer->rata_mensile) }}">
                        <div class="invalid-feedback">
                            @error('rata_mensile')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="acconto" class="form-label ps-2">Acconto</label>
                        <input type="text" class="form-control @error('acconto') is-invalid @enderror" id="acconto"
                            name="acconto" value="{{ old('acconto', $customer->acconto) }}">
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
                            value="{{ old('data_inizio_contratto', $customer->data_inizio_contratto) }}" readonly>
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
                            value="{{ old('durata_contratto_mesi', $customer->durata_contratto_mesi) }}" readonly>
                        <div class="invalid-feedback">
                            @error('durata_contratto_mesi')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-5 mb-5 d-flex justify-content-center flex-wrap" id="rate-container"></div>

                <div class="mb-3">
                    <label for="note" class="form-label ps-2">Note</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" id="note" rows="3" name="note"
                        value="{{ old('note', $customer->note) }}"></textarea>
                    <div class="invalid-feedback">
                        @error('note')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

            </section>
            <div class="mb-5 text-center">
                <button class="btn btn-lg btn-primary">MODIFICA</button>
            </div>
        </div>

        </section>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const durataContrattoInput = document.getElementById('durata_contratto_mesi');
            const rateContainer = document.getElementById('rate-container');

            // Genera immediatamente i campi delle rate
            generateRateFields();

            durataContrattoInput.addEventListener('input', function() {
                // Rigenera i campi delle rate all'evento di input
                generateRateFields();
            });

            function generateRateFields() {
                // Rimuovi i campi delle rate esistenti
                rateContainer.innerHTML = '';

                // Recupera l'oggetto delle rate dal database
                const rateObject = {!! json_encode($customer->rate_pagate ?? []) !!};

                // Recupera il numero di rate in base alla durata del contratto
                const durataContratto = parseInt(durataContrattoInput.value) || 0;
                const numRateSalvate = durataContratto > 0 ? durataContratto : 1;

                // Aggiungi direttamente i campi delle rate in base al numero di rate calcolato
                for (let i = 1; i <= numRateSalvate; i++) {
                    const label = document.createElement('label');
                    label.innerHTML = `${i}° Rata`;

                    // Aggiunto un campo checkbox per indicare se è stata pagata o meno
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = `rate_pagate[rata_${i}][pagata]`;
                    checkbox.className = 'form-check-input';
                    checkbox.checked = isRatePagata(`rata_${i}`, rateObject); // Controlla se la rata è stata pagata

                    // Aggiunto un campo di input per la data di pagamento
                    const dateInput = document.createElement('input');
                    dateInput.type = 'date';
                    dateInput.name = `rate_pagate[rata_${i}][data_pagamento]`;
                    dateInput.defaultValue = getDateForRate(`rata_${i}`,
                        rateObject); // Imposta la data di pagamento se presente

                    const div = document.createElement('div');
                    div.className = 'col-4 form-check input_rata';
                    div.appendChild(checkbox);
                    div.appendChild(label);
                    div.appendChild(dateInput);
                    rateContainer.appendChild(div);
                    // ...
                }
            }

            function getDateForRate(rata, rateObject) {
                return rateObject && rateObject[rata] && rateObject[rata].data ? rateObject[rata].data : '';
            }

            function isRatePagata(rata, rateObject) {
                // Verifica se la rata è stata pagata confrontando con l'oggetto delle rate
                return rateObject && rateObject[rata] && rateObject[rata].pagata;
            }
        });
    </script>
@endsection
