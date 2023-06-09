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
        Schema::create('field_view', function (Blueprint $table) {
            $table->id();
            $table->foreignId('view_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('field_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('row');
            $table->unsignedInteger('column');
            $table->string('text')->nullable();
            $table->timestamps();

            $table->index('view_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_view');
    }
};
