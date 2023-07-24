<?php

namespace Database\Seeders;

use App\Models\View;
use App\Support\ViewType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('views')->insert([
            [
                'id' => 1,
                'name' => 'Customer',
                'view_type' => ViewType::CONTACT->value,
                'is_default' => true
            ],
            [
                'id' => 2,
                'name' => 'Company',
                'view_type' => ViewType::CONTACT->value,
                'is_default' => false
            ],
        ]);

        DB::table('fields')->insert([
            [
                "id" => 1,
                "name" => "name",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "name",
            ],
            [
                "id" => 2,
                "name" => "firstname",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "firstname",
            ],
            [
                "id" => 3,
                "name" => "company",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "company",
            ],
            [
                "id" => 4,
                "name" => "vat_id",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "vat_id",
            ],
            [
                "id" => 5,
                "name" => "email",
                "view_type" => "contact",
                "field_type" => "email",
                "is_custom" => 0,
                "column" => "email",
            ],
            [
                "id" => 6,
                "name" => "phone",
                "view_type" => "contact",
                "field_type" => "phone",
                "is_custom" => 0,
                "column" => "phone",
            ],
            [
                "id" => 7,
                "name" => "mobile_phone",
                "view_type" => "contact",
                "field_type" => "phone",
                "is_custom" => 0,
                "column" => "mobile_phone",
            ],
            [
                "id" => 8,
                "name" => "fax",
                "view_type" => "contact",
                "field_type" => "phone",
                "is_custom" => 0,
                "column" => "fax",
            ],
            [
                "id" => 9,
                "name" => "date_of_birth",
                "view_type" => "contact",
                "field_type" => "date",
                "is_custom" => 0,
                "column" => "date_of_birth",
            ],
            [
                "id" => 10,
                "name" => "title",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "title",
            ],
            [
                "id" => 11,
                "name" => "title_after",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "title_after",
            ],
            [
                "id" => 12,
                "name" => "street",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "street",
            ],
            [
                "id" => 13,
                "name" => "zip",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "zip",
            ],
            [
                "id" => 14,
                "name" => "city",
                "view_type" => "contact",
                "field_type" => "text",
                "is_custom" => 0,
                "column" => "city",
            ],
            [
                "id" => 15,
                "name" => "country",
                "view_type" => "contact",
                "field_type" => "country",
                "is_custom" => 0,
                "column" => "country",
            ],
            [
                "id" => 16,
                "name" => "legend",
                "view_type" => "contact",
                "field_type" => "section",
                "is_custom" => 0,
                "column" => NULL,
            ],
            [
                "id" => 17,
                "name" => "contact_group",
                "view_type" => "contact",
                "field_type" => "contact_group",
                "is_custom" => 0,
                "column" => NULL,
            ],
        ]);

        DB::table('field_view')->insert([
            [
                "id" => 1,
                "view_id" => 1,
                "field_id" => 3,
                "row" => 1,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 2,
                "view_id" => 1,
                "field_id" => 16,
                "row" => 0,
                "column" => 1,
                "text" => "Data"
            ],
            [
                "id" => 3,
                "view_id" => 1,
                "field_id" => 10,
                "row" => 2,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 4,
                "view_id" => 1,
                "field_id" => 2,
                "row" => 2,
                "column" => 2,
                "text" => NULL
            ],
            [
                "id" => 5,
                "view_id" => 1,
                "field_id" => 1,
                "row" => 2,
                "column" => 3,
                "text" => NULL
            ],
            [
                "id" => 6,
                "view_id" => 1,
                "field_id" => 11,
                "row" => 2,
                "column" => 4,
                "text" => NULL
            ],
            [
                "id" => 7,
                "view_id" => 1,
                "field_id" => 4,
                "row" => 1,
                "column" => 2,
                "text" => NULL
            ],
            [
                "id" => 8,
                "view_id" => 1,
                "field_id" => 12,
                "row" => 9,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 9,
                "view_id" => 1,
                "field_id" => 13,
                "row" => 10,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 10,
                "view_id" => 1,
                "field_id" => 14,
                "row" => 10,
                "column" => 2,
                "text" => NULL
            ],
            [
                "id" => 11,
                "view_id" => 1,
                "field_id" => 15,
                "row" => 11,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 12,
                "view_id" => 1,
                "field_id" => 5,
                "row" => 5,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 13,
                "view_id" => 1,
                "field_id" => 6,
                "row" => 6,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 14,
                "view_id" => 1,
                "field_id" => 7,
                "row" => 7,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 15,
                "view_id" => 1,
                "field_id" => 8,
                "row" => 8,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 16,
                "view_id" => 1,
                "field_id" => 9,
                "row" => 3,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 17,
                "view_id" => 1,
                "field_id" => 17,
                "row" => 12,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 18,
                "view_id" => 2,
                "field_id" => 3,
                "row" => 1,
                "column" => 1,
                "text" => NULL
            ],
            [
                "id" => 19,
                "view_id" => 2,
                "field_id" => 4,
                "row" => 1,
                "column" => 2,
                "text" => NULL
            ],
        ]);
    }
}
