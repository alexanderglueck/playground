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
        Schema::create('contact_exports', function (Blueprint $table) {
            $table->id();
            $table->string('file_path')->nullable()->default(null);
            $table->foreignId('contact_group_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('started_at')->nullable()->default(null);
            $table->timestamp('completed_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_exports');
    }
};
