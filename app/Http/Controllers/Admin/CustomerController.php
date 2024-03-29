<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerController extends Controller
{

   public function index()
    {
        $customers = Customer::paginate(10);

        // Aggiorna i calcoli per ogni cliente
        foreach ($customers as $customer) {
            $dataInizioContratto = Carbon::createFromFormat('Y-m-d', $customer->data_inizio_contratto);
            $dataFineContratto = $dataInizioContratto->copy()->addMonths($customer->durata_contratto_mesi);

            $now = Carbon::now();

            if ($now < $dataInizioContratto) {
                // Contratto ancora non iniziato
                $differenzaMesi = 0;
                $mesiMancanti = $customer->durata_contratto_mesi;
                $mesiMancantiAllInizio = $now->diffInMonths($dataInizioContratto);
                if ($now->format('d') > $dataInizioContratto->format('d')) {
                    $mesiMancantiAllInizio += 1;
                }
            } else {
                // Contratto già in corso
                $differenzaGiorni = $dataInizioContratto->diffInDays($now);
                if ($now->format('m') != $dataInizioContratto->format('m')) {
                    $differenzaMesi = 1;
                } else {
                    $differenzaMesi = $differenzaGiorni > 30 ? 1 : 0;
                }
                $mesiMancanti = ($customer->durata_contratto_mesi - $differenzaMesi);
                $mesiMancantiAllInizio = 0;

                $mesiTrascorsiContratto = $dataInizioContratto->diffInMonths($now);
            }

            $customer->data_fine_contratto = $dataFineContratto;
            $customer->mesi_trascorsi_contratto = isset($mesiTrascorsiContratto) ? $mesiTrascorsiContratto : 0;
            $customer->mesi_mancanti_contratto = $customer->durata_contratto_mesi - $customer->mesi_trascorsi_contratto;
            $customer->mesi_mancanti_all_inizio = $mesiMancantiAllInizio;

            $customer->save();
        }

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $customers    = Customer::all();
        return view('admin.customers.create', compact ('customers'));
    }

    public function store(Request $request)
    {
        // $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        // Salvare i dati nel database
        $newCustomer = new Customer();
        $newCustomer->NomeAzienda             = $data['NomeAzienda'];
        $newCustomer->PIVA                    = $data['PIVA'];
        $newCustomer->indirizzo               = $data['indirizzo'];
        $newCustomer->n_civico                = $data['n_civico'];
        $newCustomer->CAP                     = $data['CAP'];
        $newCustomer->citta                   = $data['citta'];
        $newCustomer->provincia               = $data['provincia'];
        $newCustomer->nazione                 = $data['nazione'];
        $newCustomer->note                    = $data['note'];

        $newCustomer->pagamento_tot           = $data['pagamento_tot'];
        $newCustomer->rata_mensile            = $data['rata_mensile'];
        $newCustomer->acconto                 = $data['acconto'];

        $formattedCreatedAt = Carbon::now()->format('d/m/Y');
        list($day, $month, $year) = explode('/', $formattedCreatedAt);
        $newCustomer->data = Carbon::createFromFormat('d/m/Y', $formattedCreatedAt);

        $newCustomer->data_inizio_contratto   = $data['data_inizio_contratto'];
        $newCustomer->durata_contratto_mesi   = $data['durata_contratto_mesi'];

        $ratePagate = [];

        if (isset($data['rate'])) {
            // Creazione dell'array delle rate pagate
            for ($i = 1; $i <= $data['durata_contratto_mesi']; $i++) {
                $ratePagate["rata_$i"] = [
                    'pagata' => isset($data['rate_pagate']["rata_$i"]["pagata"]) ? true : false,
                    'data_pagamento' => isset($data['rate_pagate']["rata_$i"]["data_pagamento"]) ? $data['rate_pagate']["rata_$i"]["data_pagamento"] : null,
                ];
            }
        }

        $newCustomer->rate_pagate = $ratePagate;

        $newCustomer->save();

        return to_route('dashboard.customers.index', ['clienti' => $newCustomer]);
    }

    public function show(Customer $customer)
    {
        return view('admin.customers.index', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $customers = Customer::all();

        return view('admin.customers.edit', compact('customer', 'customers'));
    }

    public function update(Request $request, customer $customer)
    {
        $data = $request->all();

        $customer->NomeAzienda             = $data['NomeAzienda'];
        $customer->PIVA                    = $data['PIVA'];
        $customer->indirizzo               = $data['indirizzo'];
        $customer->n_civico                = $data['n_civico'];
        $customer->CAP                     = $data['CAP'];
        $customer->citta                   = $data['citta'];
        $customer->provincia               = $data['provincia'];
        $customer->nazione                 = $data['nazione'];
        $customer->note                    = $data['note'];

        $customer->pagamento_tot           = $data['pagamento_tot'];
        $customer->rata_mensile            = $data['rata_mensile'];
        $customer->acconto                 = $data['acconto'];

        $formattedCreatedAt = Carbon::now()->format('d/m/Y');
        list($day, $month, $year) = explode('/', $formattedCreatedAt);
        $customer->data = Carbon::create($year, $month, $day);

        $customer->data_inizio_contratto   = $data['data_inizio_contratto'];
        $customer->durata_contratto_mesi   = $data['durata_contratto_mesi'];

        $ratePagate = [];

        if (isset($data['rate'])) {
            // Creazione dell'array delle rate pagate
            for ($i = 1; $i <= $data['durata_contratto_mesi']; $i++) {
                $ratePagate["rata_$i"] = [
                    'pagata' => isset($data['rate_pagate']["rata_$i"]["pagata"]) ? true : false,
                    'data_pagamento' => isset($data['rate_pagate']["rata_$i"]["data_pagamento"]) ? $data['rate_pagate']["rata_$i"]["data_pagamento"] : null,
                ];
            }
        }

        // Aggiorna solo i valori delle rate_pagate invece di sovrascrivere l'intero campo
        $customer->rate_pagate = array_merge($customer->rate_pagate ?? [], $ratePagate);

        $customer->update($data);

        return redirect()->route('dashboard.customers.index');
    }

    public function destroy(customer $customer)
    {
        //
    }
}
