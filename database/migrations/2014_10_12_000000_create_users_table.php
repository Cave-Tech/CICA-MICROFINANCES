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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->foreign('profiles_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('type_employe_id')->references('id')->on('employee_types')->onDelete('cascade')->nullable();
            //$table->foreign('type_agent')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('id_agent')->constrained()->OnDelete('cascade');
=======
            $table->unsignedBigInteger('profiles_id');
            $table->unsignedBigInteger('type_employe_id');
            $table->unsignedBigInteger('agent_id')->nullable();         
>>>>>>> 6f98568311a6207d878b5dbd78c0a4d184518580
            $table->string('name');
            $table->string('profile_picture');
            $table->string('status');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('profiles_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('type_employe_id')->references('id')->on('employee_types')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
