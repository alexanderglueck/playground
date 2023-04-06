<?php

namespace Database\Factories;

use App\Models\Field;
use App\Support\ViewType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FieldFactory extends Factory
{
    protected $model = Field::class;

    public function definition(): array
    {
        return [
            'name' => 'lastname',
            'view_type' => ViewType::CUSTOMER,
            'field_type' => 'text',
            'is_custom' => false,
            'column' => 'name'
        ];
    }
}
