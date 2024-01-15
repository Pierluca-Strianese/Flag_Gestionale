@extends('admin.layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $quote = session('delete_success') @endphp
        <div class="alert alert-danger">
            The quote "{{ $quote->title }}" has been Deleted
            <form action="{{ route('admin.quote.cancel', ['quote' => $quote]) }}" method="post" class="d-inline-block">
                @csrf
                <button class="btn btn-warning">Cancel</button>
            </form>
        </div>
    @endif

    <div>
        <table class="table align-middle table-striped table_p">
            <thead>
                <tr>
                    <th scope="col" class="text-center col-1">Nome Azienda</th>
                    <th scope="col" class="text-center col-1">Acconto</th>
                    <th scope="col" class="text-center col-1">Rata Mensile</th>
                    <th scope="col" class="col-2">
                        <div class="d-flex justify-content-end">
                            @for ($i = 3; $i >= 1; $i--)
                                <div class="button_month_name_passed">
                                    {{ Carbon\Carbon::now()->subMonths($i)->formatLocalized('%b') }}
                                </div>
                            @endfor
                        </div>
                    </th>
                    <th scope="col" class="col-6">
                        <div class="d-flex">
                            @for ($i = 0; $i < 9; $i++)
                                <div class="button_month_name justify-content-start">
                                    {{ Carbon\Carbon::now()->addMonths($i)->formatLocalized('%b') }}
                                </div>
                            @endfor
                        </div>
                    </th>
                    <th scope="col" class="text-end col-2">Azioni</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($customers as $customer)
                    <tr>
                        <th scope="row" class="text-center">{{ $customer->NomeAzienda }}</th>
                        <td class="text-center">{{ $customer->acconto }} €</td>
                        <td class="text-center">{{ $customer->rata_mensile }}</td>
                        <td>
                            <div class="d-flex flex-row-reverse">
                                @for ($i = 1; $i <= 3; $i++)
                                    @php
                                        $ratePagate = $customer->rate_pagate ?? [];
                                        $key = 'rata_' . ($customer->mesi_trascorsi_contratto - ($i - 1));
                                        $rata = $ratePagate[$key] ?? null;
                                        $rataPagata = is_array($rata) && isset($rata['pagata']) ? $rata['pagata'] : false;
                                        $dataPagamento = is_array($rata) && isset($rata['data_pagamento']) ? $rata['data_pagamento'] : null;
                                    @endphp

                                    @if ($customer->mesi_trascorsi_contratto == 0)
                                        <div class="button_month_empty_passed"></div>
                                    @else
                                        <div class="button_month_passed {{ $rataPagata ? 'pagata' : 'non_pagata' }}">
                                            @if ($dataPagamento)
                                                {{ \Illuminate\Support\Carbon::parse($dataPagamento)->format('d/m') }}
                                            @endif
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-start flex-nowrap">
                                @php
                                    $ratePagate = $customer->rate_pagate ?? [];
                                    $mesiTrascorsi = $customer->mesi_trascorsi_contratto;
                                    $mesiMancanti = $customer->mesi_mancanti_contratto;
                                    $mesiMancantiAllInizio = $customer->mesi_mancanti_all_inizio ?? 0;
                                    $maxDivs = 9;
                                @endphp

                                @for ($i = 1; $i <= $maxDivs; $i++)
                                    @php
                                        $key = 'rata_' . ($mesiTrascorsi + $i);
                                        $rata = $ratePagate[$key] ?? null;
                                        $rataPagata = is_array($rata) && isset($rata['pagata']) ? $rata['pagata'] : false;
                                        $dataPagamento = is_array($rata) && isset($rata['data_pagamento']) ? $rata['data_pagamento'] : null;
                                    @endphp

                                    @if ($i <= $mesiMancantiAllInizio || $i > $mesiMancantiAllInizio + $mesiMancanti)
                                        <div class="button_month_empty"></div>
                                    @else
                                        <div class="button_month_missing {{ $rataPagata ? 'pagata' : 'non_pagata' }}">
                                            @if ($dataPagamento)
                                                {{ \Illuminate\Support\Carbon::parse($dataPagamento)->format('d/m') }}
                                            @endif
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td class="text-end">
                            <a class="btn btn-secondary m-1"
                                href="{{ route('dashboard.customers.edit', ['customer' => $customer]) }}">
                                <i class="fa-solid fa-pen-to-square"></i> MODIFICA
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end p-2">
        <button class="btn btn-outline-success me-3">
            <a class="dropdown-item" href="{{ route('dashboard.customers.create') }}">Nuovo Azienda</a>
        </button>
    </div>

    <div class="d-flex justify-content-end p-2">{{ $customers->links() }}</div>
@endsection
