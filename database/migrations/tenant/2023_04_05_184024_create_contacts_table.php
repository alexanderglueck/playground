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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('vat_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('fax')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('title')->nullable();
            $table->string('title_after')->nullable();
            $table->string('street')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->foreignId('view_id')->nullable()
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
