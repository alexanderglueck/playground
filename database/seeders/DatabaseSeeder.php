<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('views')
            ->insert([
                [
                    'name' => 'Customer',
                    'view_type' => 'customer',
                    'is_default' => false
                ],
                [
                    'name' => 'Company',
                    'view_type' => 'customer',
                    'is_default' => true
                ],
            ]);

        DB::table('fields')
            ->insert([
                [
                    'name' => 'Name',
                    'view_type' => 'customer',
                    'field_type' => 'text',
                    'is_custom' => false,
                    'column' => 'name'
                ],
                [
                    'name' => 'Created at',
                    'view_type' => 'customer',
                    'field_type' => 'text',
                    'is_custom' => false,
                    'column' => 'created_at'
                ],
                [
                    'name' => 'Weight',
                    'view_type' => 'customer',
                    'field_type' => 'decimal',
                    'is_custom' => true,
                    'column' => '0_double_1'
                ],
            ]);

        DB::table('field_view')
            ->insert([
                [
                    'view_id' => 1,
                    'field_id' => 1,
                ],
                [
                    'view_id' => 1,
                    'field_id' => 3,
                ],
                [
                    'view_id' => 2,
                    'field_id' => 2,
                ],
            ]);

        DB::table('contacts')
            ->insert([
                [
                    'name' => 'John Doe',
                    'view_id' => null,
                ],
                [
                    'name' => 'Jane Doe',
                    'view_type' => 1,
                ],
            ]);
    }
}
