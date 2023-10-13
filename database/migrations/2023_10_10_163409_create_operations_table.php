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
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');            
            $table->unsignedBigInteger('agent_id');
            $table->foreign('operation_type_id')->references('id')->on('operation_types')->onDelete('cascade');
            $table->double('withdrawal_amount');
            $table->string('withdrawal_method');
            $table->date('withdrawal_date');
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
