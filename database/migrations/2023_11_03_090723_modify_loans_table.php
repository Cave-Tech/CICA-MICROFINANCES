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
        Schema::table('loans', function (Blueprint $table) {
            // Rendre certaines colonnes nullable
            $table->unsignedBigInteger('agent_id')->nullable()->change();
            $table->unsignedBigInteger('loan_type_id')->nullable()->change();
            $table->double('loan_amount')->nullable()->change();
            $table->double('interest_rate')->nullable()->change();
            $table->integer('payment_frequency')->nullable()->change();
            $table->date('loan_date')->nullable()->change();
            $table->date('due_date')->nullable()->change();

            // Ajouter de nouvelles colonnes
            $table->string('type_warranty')->nullable();
            $table->double('value_warranty')->nullable();
            $table->text('details_warranty')->nullable();
            $table->text('purpose_warranty')->nullable();
            $table->text('removals_plan')->nullable();
            $table->string('name_warrantor')->nullable();
            $table->text('address_warrantor')->nullable();
            $table->string('number_warrantor')->nullable();
            $table->string('relation_warrantor')->nullable();
            $table->string('doc_files')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
