<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Contacts
            'view-contacts',
            'create-contacts',
            'update-contacts',
            'delete-contacts',
            // TODO Uncomment when implementing soft delete for contacts
            //'restore-contacts',
            //'force-delete-contacts',

            // Contact Groups
            'view-contact-groups',
            'create-contact-groups',
            'update-contact-groups',
            'delete-contact-groups',

            // Events
            'view-events',
            'create-events',
            'update-events',
            'delete-events',

            // Invoices
            'view-invoices',
            'create-invoices',
            'update-invoices',
            'delete-invoices',

            // Invoice Options
            'view-invoice-options',
            'create-invoice-options',
            'update-invoice-options',
            'delete-invoice-options',

            // Roles
            'view-roles',
            'create-roles',
            'update-roles',
            'delete-roles',

            // Notebooks
            'view-notebooks',
            'create-notebooks',
            'update-notebooks',
            'delete-notebooks',

            // Tags
            'view-tags',
            'create-tags',
            'update-tags',
            'delete-tags',

            // Notes
            'view-notes',
            'create-notes',
            'update-notes',
            'delete-notes',

            // Views
            'view-views',
            'create-views',
            'update-views',
            'delete-views',

            // Sharable Links
            'create-sharable-links',
            'delete-sharable-links',

            // Users
            'view-users',
            'create-users',
            'update-users',
            'delete-users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }
    }
}
