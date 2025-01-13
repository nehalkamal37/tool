<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id(); 
            $table->string('drug_name');
            $table->string('ndc')->nullable(); 
            $table->string('form')->nullable();
            $table->string('strength')->nullable();
            $table->string('mfg')->nullable(); 
            $table->decimal('acq', 10, 2)->nullable(); 
            $table->decimal('awp', 10, 2)->nullable(); 
            $table->string('dispensed')->nullable(); 
            $table->string('p_update')->nullable(); 
            $table->string('rxCUI')->nullable(); 
            $table->string('epc_class')->nullable(); 
            $table->string('drug_class')->nullable(); 
                });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
