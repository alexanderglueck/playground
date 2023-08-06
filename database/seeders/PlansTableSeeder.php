<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            [
                "id" => 1,
                "name" => "basic",
                "gateway_id" => config('services.stripe.plans.basic'),
                "slug" => "basic",
                "price" => 3000,
                "active" => 1,
            ],
        ]);
    }
}
