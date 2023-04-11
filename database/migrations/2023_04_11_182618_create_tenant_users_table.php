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
        Schema::create('tenant_user', function (Blueprint $table) {
            $table->id();
            $table->string('tenant');
            $table->string('email')->index();
            $table->timestamps();

            $table->foreign('tenant')
                ->references('id')
                ->on('tenants')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unique(['tenant', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_user');
    }
};
