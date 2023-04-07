<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Support\CustomFielded;
use App\Support\CustomFieldModel;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class CreateCustomTableMigrationCommand extends Command
{
    protected $signature = 'app:create-custom-table-setup {className}';

    protected $description = 'Create the custom table setup for a specified class. Includes migration, trigger and custom class';

    public function handle(): void
    {
        $classNameArgument = $this->argument('className');

        if ( ! $this->classExists($classNameArgument)) {
            $this->error('Class does not exist!');
            return;
        }

        $this->createCustomClass($classNameArgument);

        $this->createMigration($classNameArgument);

        $this->createTrigger($classNameArgument);
    }

    private function getModelClassPath(): string
    {
        $instance = new User();
        $classPath = get_class($instance);

        return Str::remove($this->getClassName($classPath), $classPath);
    }

    private function getClassName($fullClassPath): string
    {
        if ($pos = strrpos($fullClassPath, '\\')) {
            return substr($fullClassPath, $pos + 1);
        }

        return $pos;
    }

    private function classExists(string $classNameArgument): bool
    {
        $classPath = $this->getModelClassPath();

        return class_exists($classPath . $classNameArgument);
    }

    private function getMigrationName(string $classNameArgument): string
    {
        $date = date('Y_m_d_His');

        return "{$date}_create_custom_{$this->getTableName($classNameArgument)}_table";
    }

    private function getTableName(string $classNameArgument): string
    {
        $classPath = $this->getModelClassPath();

        /** @var Model $instance */
        $instance = new ($classPath . $classNameArgument);

        return $instance->getTable();
    }

    private function createCustomClass(string $classNameArgument): void
    {
        $className = app_path("Support/Custom$classNameArgument.php");

        $content = Blade::render(file_get_contents(resource_path('stubs/custom_class.stub')), [
            'php' => '<?php',
            'className' => $classNameArgument
        ]);

        file_put_contents(
            $className,
            $content
        );
    }

    private function createMigration(string $classNameArgument): void
    {
        $migrationName = $this->getMigrationName($classNameArgument);

        /** @var Model|CustomFielded $instance */
        $instance = new ($this->getModelClassPath() . $classNameArgument);

        $content = Blade::render(file_get_contents(resource_path('stubs/create_custom_table_migration.stub')), [
            'php' => '<?php',
            'tableName' => 'custom_' . $this->getTableName($classNameArgument),
            'primaryKeyName' => CustomFieldModel::$customTableKey,
            'foreignKeyTable' => $instance->getTable(),
            'foreignKeyName' => $instance->getKeyName(),
        ]);

        // TODO Change migration path once tenancy is used (See https://tenancyforlaravel.com/docs/v3/migrations)
        file_put_contents(database_path("migrations/$migrationName.php"), $content);
    }

    private function createTrigger(string $classNameArgument): void
    {
        /** @var Model|CustomFielded $instance */
        $instance = new ($this->getModelClassPath() . $classNameArgument);

        $triggerName = "custom_fields_after_{$instance->getTable()}_insert";

        $triggerFileName = date('Y_m_d_His') . '_create_' . $triggerName . '_trigger.php';

        $content = Blade::render(file_get_contents(resource_path('stubs/custom_trigger.stub')), [
            'php' => '<?php',
            'triggerName' => $triggerName,
            'baseTableName' => $instance->getTable(),
            'tableName' => 'custom_' . $instance->getTable(),
            'primaryKeyName' => CustomFieldModel::$customTableKey,
            'foreignKeyName' => $instance->getKeyName()
        ]);

        // TODO Change trigger path once tenancy is used (See https://tenancyforlaravel.com/docs/v3/migrations)
        file_put_contents(database_path("migrations/$triggerFileName.php"), $content);
    }
}
