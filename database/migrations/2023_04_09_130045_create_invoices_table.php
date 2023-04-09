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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('contact_id')->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('invoice_option_id')->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();

            $table->unique(['number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
