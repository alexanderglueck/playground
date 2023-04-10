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
        DB::unprepared('CREATE TRIGGER contact_group_user_after_insert AFTER INSERT ON `contact_groups` FOR EACH ROW
            BEGIN
                INSERT INTO `contact_group_user` (`contact_group_id`, `user_id`, `privilege`)
                SELECT NEW.id, id, "none" FROM `users`;
            END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER `contact_group_user_after_insert`");
    }
};
