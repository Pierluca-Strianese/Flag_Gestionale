<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('NomeAzienda',100);
            $table->string('PIVA',20);
            $table->string('email',20) -> nullable();
            $table->integer('telefono') -> nullable();
            $table->string('indirizzo',50);
            $table->integer('n_civico');
            $table->string('CAP',8);
            $table->string('citta',20);
            $table->string('provincia',4);
            $table->string('nazione',20);
            $table->string('note',100) -> nullable();

            $table->integer('pagamento_tot') -> default(0);
            $table->integer('rata_mensile') -> default(0);
            $table->integer('acconto') -> default(0);

            $table->date('data_inizio_contratto')->nullable();
            $table->integer('durata_contratto_mesi')->nullable();
            $table->date('data_fine_contratto')->nullable();
            $table->integer('mesi_trascorsi_contratto')->nullable();
            $table->integer('mesi_mancanti_contratto')->nullable();
            $table->integer('mesi_mancanti_all_inizio')->nullable();

            $table->json('rate_pagate')->nullable();

            $table->timestamp('data')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
