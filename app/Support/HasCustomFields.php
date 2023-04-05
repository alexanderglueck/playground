<?php

namespace App\Support;

use App\Models\Field;
use App\Models\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait HasCustomFields
{
    protected array $loadedCustomTables = [];

    private static string $customTableKey = 'entity_id';

    public function fields(): Collection
    {
        return View::fields($this);
    }

    public function getViewId(): ?int
    {
        return $this->view_id;
    }

    public function fieldValue(Field $field)
    {
        if ( ! $field->isCustomField()) {
            return $this->{$field->column};
        }

        $table = View::getCustomTable($field);

        if ($this->isCustomTableLoaded($table)) {
            return $this->{$field->column};
        }

        $this->loadCustomTable($table);

        return $this->{$field->column};
    }

    protected function isCustomTableLoaded(string $table): bool
    {
        return in_array($table, $this->loadedCustomTables);
    }

    protected function loadCustomTable(string $table): void
    {
        $cols = DB::table($table)
            ->select('*')
            ->where(self::$customTableKey, '=', $this->getKey())
            ->first();

        foreach ($cols as $column => $value) {
            if ($column === self::$customTableKey) {
                continue;
            }

            $this->{$column} = $value;
        }

        $this->loadedCustomTables[] = $table;
    }
}
