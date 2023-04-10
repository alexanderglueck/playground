<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('CREATE TRIGGER custom_fields_after_contacts_insert AFTER INSERT ON `contacts` FOR EACH ROW
            BEGIN
                INSERT INTO `custom_contacts` (`entity_id`)
                VALUES (NEW.id);
            END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER `custom_fields_after_contacts_insert`");
    }
};
