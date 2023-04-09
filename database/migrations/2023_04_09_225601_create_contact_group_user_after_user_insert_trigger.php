<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('CREATE TRIGGER contact_group_user_after_user_insert AFTER INSERT ON `users` FOR EACH ROW
            BEGIN
                INSERT INTO `contact_group_user` (`contact_group_id`, `user_id`, `privilege`)
                SELECT id, NEW.id, "none" FROM `contact_groups`;
            END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER `contact_group_user_after_user_insert`");
    }
};
