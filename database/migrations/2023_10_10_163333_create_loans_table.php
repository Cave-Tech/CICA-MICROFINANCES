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
            $table->foreign('borrower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');
            $table->double('loan_amount');
            $table->double('interest_rate');
            $table->int('payment_frequency');
            $table->string('status');
            $table->date('loan_date');
            $table->date('due_date');    
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
