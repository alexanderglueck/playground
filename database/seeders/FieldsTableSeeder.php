<?php

namespace Database\Seeders;

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
            ]
        );
    }
}
