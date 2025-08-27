<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->date('payment_date');
            $table->string('payment_method');
            $table->enum('status', ['paid', 'pending', 'overdue']);
            $table->timestamps();

            $table->index('parent_id');      // quickly fetch all payments by a parent
            $table->index('payment_date');   // filter by date ranges (monthly reports, etc.)
            $table->index('status');         // filter unpaid/overdue invoices
            $table->index('payment_method');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
