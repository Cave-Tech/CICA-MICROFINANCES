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
            $table->unsignedBigInteger('borrower_id');
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('agent_terain_id')->nullable();
            $table->unsignedBigInteger('loan_type_id');
            $table->double('loan_amount')->nullable();
            $table->double('interest_rate')->nullable();
            $table->integer('payment_frequency')->nullable();
            $table->string('status')->nullable();
            $table->string('reject_reason')->nullable();
            $table->date('loan_date')->nullable();
            $table->date('due_date')->nullable();   
            $table->string('applicant_type')->nullable();
            $table->string('loan_reason')->nullable();
            $table->string('repayment_interval')->nullable();
            $table->string('loan_pieces')->nullable();
            $table->timestamps();

            //Informations pour prêt groupé
            $table->string('name_crew')->nullable();
            $table->string('tel_crew')->nullable();
            $table->string('address_crew')->nullable();
            $table->string('num')->nullable();


            $table->foreign('borrower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agent_terain_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');
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
