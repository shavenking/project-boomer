<?php

use Illuminate\Database\Seeder;

use App\Entities\Contract\ResourceTypeContract;
use App\Entities\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = (new Permission)->getTable();
        $table = DB::table($tableName);

        $types = $this->getResourceTypes();
        $actions = $this->getActions();

        $inserts = [];
        foreach ($actions as $action) {
            foreach ($types as $type) {
                $inserts[] = [
                    'name' => "{$action}_{$type}",
                    'display_name' => "{$action}_{$type}"
                ];
            }
        }

        $table->truncate();
        $table->insert($inserts);
    }

    private function getResourceTypes()
    {
        $entityPath = app_path('Entities');
        $filesystem = app('files');
        $paths = $filesystem->files($entityPath);
        $namespace = 'App\\Entities';

        // get possible classes from filenames
        $classes = array_map(function ($path) use ($filesystem, $namespace) {
            $className = $filesystem->name($path);

            return "$namespace\\$className";
        }, $paths);

        // always include User model
        $classes[] = config('auth.model');

        $classes = collect($classes);
        $types = $classes->map(function ($className) use ($filesystem, $namespace) {
            $class = new \ReflectionClass($className);

            if (
                !$class->implementsInterface(ResourceTypeContract::class)
                || !$class->isInstantiable()
            ) {
                return;
            }

            $type = $class->newInstanceWithoutConstructor()->getResourceType();

            return $type;
        })->filter();

        return $types;
    }
    private function getActions()
    {
        return [
            'create',
            'read',
            'update',
            'delete',
            'start_review',
            'proceed_review',
            'reject_review',
            'cancel_review'
        ];
    }
}
