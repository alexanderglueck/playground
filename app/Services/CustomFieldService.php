<?php

namespace App\Services;

use App\Data\CustomFieldData;
use App\Models\Field;
use App\Models\User;
use App\Support\ViewType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CustomFieldService
{
    public function getCustomFields(ViewType $viewType): Collection
    {
        return Field::query()
            ->where('is_custom', '=', 1)
            ->where('view_type', '=', $viewType->value)->get();
    }

    public function createCustomField(User $user, CustomFieldData $data, ViewType $viewType): Field
    {
        $field = new Field();
        $field->fill($data->toArray());
        $field->column = 'custom_' . Str::uuid()->toString();
        $field->view_type = $viewType;
        $field->is_custom = true;
        $field->save();

        $tableName = $this->getTableName($viewType);

        Schema::table($tableName, function (Blueprint $table) use ($field) {
            switch ($field->field_type) {
                case 'text':
                case 'phone':
                case 'email':
                    $table->string($field->column)->nullable()->default(null);
                    break;
                case 'date':
                    $table->date($field->column)->nullable()->default(null);
                    break;
            }
        });

        return $field;
    }

    public function deleteCustomField(User $user, Field $field): void
    {
        $tableName = $this->getTableName($field->view_type);

        Schema::table($tableName, function (Blueprint $table) use ($field) {
            $table->dropColumn($field->column);
        });

        $field->delete();
    }

    private function getTableName(ViewType $viewType): string
    {
        return match ($viewType) {
            ViewType::CONTACT => 'custom_contacts',
            ViewType::TASK => throw new \Exception('To be implemented')
        };
    }
}
