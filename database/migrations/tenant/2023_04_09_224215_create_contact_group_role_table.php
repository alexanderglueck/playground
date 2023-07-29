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
        Schema::create('contact_group_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_group_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('role_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('privilege');
            $table->timestamps();

            $table->unique(['contact_group_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_group_role');
    }
};
