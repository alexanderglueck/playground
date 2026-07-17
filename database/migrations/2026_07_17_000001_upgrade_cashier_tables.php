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
        // Cashier 15: the "name" column was renamed to "type".
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->renameColumn('name', 'type');
        });

        Schema::table('subscription_items', function (Blueprint $table) {
            $table->dropUnique(['subscription_id', 'stripe_price']);
            $table->index(['subscription_id', 'stripe_price']);
        });

        // Cashier 16: meter columns for usage-based billing.
        Schema::table('subscription_items', function (Blueprint $table) {
            $table->string('meter_event_name')->nullable()->after('stripe_price');
            $table->string('meter_id')->nullable()->after('meter_event_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_items', function (Blueprint $table) {
            $table->dropColumn(['meter_event_name', 'meter_id']);
        });

        Schema::table('subscription_items', function (Blueprint $table) {
            $table->dropIndex(['subscription_id', 'stripe_price']);
            $table->unique(['subscription_id', 'stripe_price']);
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->renameColumn('type', 'name');
        });
    }
};
