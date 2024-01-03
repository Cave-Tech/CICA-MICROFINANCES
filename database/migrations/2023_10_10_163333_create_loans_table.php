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
            $table->double('loan_amount');
            $table->double('interest_rate');
            $table->integer('payment_frequency');
            $table->string('status');
            $table->string('reject_reason')->nullable();
            $table->date('loan_date');
            $table->date('due_date');    
            $table->string('applicant_type')->nullable();
            $table->string('loan_reason')->nullable();
            $table->string('repayment_interval')->nullable();
            $table->timestamps();

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
