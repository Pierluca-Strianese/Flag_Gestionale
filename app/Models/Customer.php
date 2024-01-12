<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'NomeAzienda',
        'CF',
        'PIVA',
        'email',
        'telefono',
        'indirizzo',
        'n_civico',
        'CAP',
        'citta',
        'provincia',
        'nazione',
        'MetodoPagamento',
        'IBAN',
        'note',
        'pagamento_tot',
        'rata_mensile',
        'acconto',
        'data_inizio_contratto',
        'durata_contratto_mesi',
        'rate_pagate',
    ];

    protected $casts = [
        'rate_pagate' => 'array',
    ];
}
