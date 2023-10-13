<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_emprunteur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_agent')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_type_pret')->references('id')->on('loan_types')->onDelete('cascade');
            $table->double('montant_pret');
            $table->double('taux_interet');
            $table->int('frequence_paiement');
            $table->string('status');
            $table->date('date_pret');
            $table->date('date_echeance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
