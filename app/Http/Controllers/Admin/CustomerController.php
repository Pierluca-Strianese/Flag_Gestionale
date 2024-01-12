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

            $differenzaMesi = $dataInizioContratto->diffInMonths(Carbon::now());
            $mesiMancanti = $customer->durata_contratto_mesi - $differenzaMesi;

            $customer->data_fine_contratto = $dataFineContratto;
            $customer->mesi_trascorsi_contratto = $differenzaMesi;
            $customer->mesi_mancanti_contratto = $mesiMancanti;

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
        $newCustomer->CF                      = $data['CF'];
        $newCustomer->PIVA                    = $data['PIVA'];
        $newCustomer->indirizzo               = $data['indirizzo'];
        $newCustomer->n_civico                = $data['n_civico'];
        $newCustomer->CAP                     = $data['CAP'];
        $newCustomer->citta                   = $data['citta'];
        $newCustomer->provincia               = $data['provincia'];
        $newCustomer->nazione                 = $data['nazione'];
        $newCustomer->MetodoPagamento         = $data['MetodoPagamento'];
        $newCustomer->IBAN                    = $data['IBAN'];
        $newCustomer->note                    = $data['note'];

        $newCustomer->pagamento_tot           = $data['pagamento_tot'];
        $newCustomer->rata_mensile            = $data['rata_mensile'];
        $newCustomer->acconto                 = $data['acconto'];

        $formattedCreatedAt = Carbon::now()->format('d/m/Y');
        list($day, $month, $year) = explode('/', $formattedCreatedAt);
        $newCustomer->data = Carbon::create($year, $month, $day);

        $newCustomer->data_inizio_contratto   = $data['data_inizio_contratto'];
        $newCustomer->durata_contratto_mesi   = $data['durata_contratto_mesi'];

        $ratePagate = [];

        if (isset($data['rate'])) {
            // Creazione dell'array delle rate pagate
            for ($i = 1; $i <= $data['durata_contratto_mesi']; $i++) {
                $ratePagate["rata_$i"] = [
                    'importo' => isset($data['rate']["rata_$i"]) ? $data['rate']["rata_$i"] : null,
                    'pagata' => isset($data['rate_pagate']["rata_$i"]) ? true : false,
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
        $customer->CF                      = $data['CF'];
        $customer->PIVA                    = $data['PIVA'];
        $customer->indirizzo               = $data['indirizzo'];
        $customer->n_civico                = $data['n_civico'];
        $customer->CAP                     = $data['CAP'];
        $customer->citta                   = $data['citta'];
        $customer->provincia               = $data['provincia'];
        $customer->nazione                 = $data['nazione'];
        $customer->MetodoPagamento         = $data['MetodoPagamento'];
        $customer->IBAN                    = $data['IBAN'];
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
                    'importo' => isset($data['rate']["rata_$i"]) ? $data['rate']["rata_$i"] : null,
                    'pagata' => isset($data['rate_pagate']["rata_$i"]) ? true : false,
                ];
            }
        }

        $newCustomer->rate_pagate = $ratePagate;

        $customer->update($data);

        return redirect()->route('dashboard.customers.index');
    }

    public function destroy(customer $customer)
    {
        //
    }
}
