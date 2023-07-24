<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantDatabaseSeeder extends Seeder
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

        $this->call(PermissionsTableSeeder::class);
        $this->call(FieldsTableSeeder::class);

        DB::table('roles')->insert([
            [
                'name' => 'Administrator',
            ],
        ]);

        $role = Role::first();

        DB::table('permission_role')->insert(
            Permission::query()->get('id')->map(function (Permission $permission) use ($role) {
                return [
                    'permission_id' => $permission->id,
                    'role_id' => $role->id
                ];
            })->toArray()
        );
    }
}
