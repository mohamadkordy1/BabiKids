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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('specialization');
            $table->text('bio')->nullable();
            $table->date('hired_date');
            $table->timestamps();

            $table->index('user_id');          // fast lookups when joining staff with users
            $table->index('specialization');   // useful if you often filter/search staff by specialization (e.g., "teacher", "nurse")
            $table->index('hired_date');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
