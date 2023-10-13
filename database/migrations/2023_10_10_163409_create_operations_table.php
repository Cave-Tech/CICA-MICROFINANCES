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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');            
            $table->id('id_agent');
            $table->foreign('OperationType_id')->references('id')->on('operation_types')->onDelete('cascade');
            $table->double('montant_retrait');
            $table->string('moyen_de_retrait');
            $table->date('date_retrait');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
