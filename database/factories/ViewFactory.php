<?php

namespace Database\Factories;

use App\Models\View;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewFactory extends Factory
{
    protected $model = View::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'view_type' => ViewType::CUSTOMER->value,
            'is_default' => false
        ];
    }
}
