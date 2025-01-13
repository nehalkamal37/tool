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
        Schema::create('scripts', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('Date', 255)->nullable(); // Assuming this is a varchar for date storage
            $table->integer('Script')->nullable();
            $table->integer('R_number')->nullable();
            $table->integer('RA')->nullable();
            $table->string('Drug_Name', 255)->nullable();
            $table->string('Ins', 50)->nullable();
            $table->string('PF', 50)->nullable();
            $table->string('Prescriber', 255)->nullable();
            $table->decimal('Qty', 10, 2)->nullable(); // Decimal with precision and scale
            $table->decimal('ACQ', 10, 2)->nullable(); // Acquisition cost
            $table->decimal('Discount', 10, 2)->nullable();
            $table->decimal('Ins_Pay', 10, 2)->nullable();
            $table->decimal('Pat_Pay', 10, 2)->nullable();
            $table->string('NDC', 50)->nullable();
            $table->string('RxCui')->nullable();
            $table->string('Class', 255)->nullable();
            $table->decimal('Net_profit', 10, 2)->nullable();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scripts');
    }
};
