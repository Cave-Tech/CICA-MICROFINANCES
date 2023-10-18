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
            $table->unsignedBigInteger('profiles_id');
            $table->unsignedBigInteger('type_employe_id')->nullable();
            $table->unsignedBigInteger('agent_id')->nullable();         
            $table->string('name');
            $table->string('profile_picture')->default('default-profile-icon.png');
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
